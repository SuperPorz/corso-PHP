<?php

    ################################################
    # INCLUDES
    //includes generici
    include 'inc/DatabaseConnection.php';
    include 'class/DatabaseTable.php';
    require_once 'lib/ext/autoload.php';
    
    //includes classi CLIENTE
    foreach (glob("class/cliente/*.php") as $file) {
        require_once $file;
    }

    //includes classi GESTORE
    foreach (glob("class/gestore/*.php") as $file) {
        require_once $file;
    }

    //includes classi PRENOTAZIONE
    foreach (glob("class/prenotazione/*.php") as $file) {
        require_once $file;
    }


    ################################################
    # CONFIGURAZIONE TWIG
    $loader = new \Twig\Loader\FilesystemLoader('tpl');
    $twig = new \Twig\Environment($loader);


    ################################################
    # ISTANZE
    //tabelle DB
    $tab_cliente = new DatabaseTable($pdo, 'cliente', 'idc');
    $tab_gestore = new DatabaseTable($pdo, 'gestore', 'idg');
    $tab_prenotazione = new DatabaseTable($pdo, 'prenotazione', 'idp');

    //controllers
    $cCliente = new cCliente($tab_cliente);
    $cGestore = new cGestore($tab_gestore);
    $cPrenotazione = new cPrenotazione($tab_prenotazione);

    //views 
    $vClienti = new vCliente($tab_cliente);
    $vGestori = new vGestore($tab_gestore);


    ################################################
    # GESTIONE AZIONI CLIENTE  
    // aggiungi
    if (isset($_POST['idc']) && isset($_POST['nome']) && isset($_POST['mail'])) {
        $mCliente = new mCliente($_POST['nome'], $_POST['mail']);
        $cCliente->aggiungi_cliente($mCliente);
    }
    // elimina
    if (isset($_POST['azione']) && $_POST['azione'] == 'elimina' && 
        isset($_POST['idc'])) {
            $cCliente->elimina_cliente($_POST['idc']);
    }


    ################################################
    # GESTIONE AZIONI GESTORE
    // aggiungi
    if (isset($_POST['idg']) && isset($_POST['nome']) && isset($_POST['numero'])) {
        $mGestore = new mGestore($_POST['nome'], $_POST['numero']);
        $cGestore->aggiungi_gestore($mGestore);
    }
    // elimina
    if (isset($_POST['azione']) && $_POST['azione'] == 'elimina' && 
        isset($_POST['idg'])) {
            $cGestore->elimina_gestore($_POST['idg']);
    }


    ################################################
    # GESTIONE AZIONI PRENOTAZIONE 
    // aggiungi
    if (isset($_POST['azione']) && $_POST['azione'] == 'prenota'
        && isset($_POST['idg']) && isset($_POST['data']) && isset($_POST['ora'])) {
            $mPrenotazione = new mPrenotazione($_POST['idg'], $_POST['data'], $_POST['ora']);
            $cPrenotazione->aggiungi_prenotazione($mPrenotazione);
    }
    // elimina
    if (isset($_POST['azione']) && $_POST['azione'] == 'elimina' && 
        isset($_POST['idp'])) {
            $cPrenotazione->elimina_prenotazione($_POST['idp']);
    }


    ################################################
    # RENDERING
    
    // Qui $p ha SEMPRE un valore (mai null o indefinito)
    $p = isset($_REQUEST['p']) ? $_REQUEST['p'] : 'index';


    switch ($p) {
    case 'clienti':
        $template = $vClienti->carica_tpl_clienti($twig);
        $data = [
            'lista_clienti' => $vClienti->mostra_lista_clienti(),
            'pagine' => [
                ['url' => 'gestori.html','label' => 'GESTORI'],
                ['url' => 'clienti.html','label' => 'CLIENTI']
            ]
        ];
        echo $template->render($data);
        break;
    
    case 'gestori':
        $template = $vGestori->carica_tpl_gestori($twig);
        $data = [
            'lista_gestori' => $vGestori->mostra_lista_gestori(),
            'pagine' => [
                ['url' => 'gestori.html','label' => 'GESTORI'],
                ['url' => 'clienti.html','label' => 'CLIENTI']
            ]
        ];
        echo $template->render($data);
        break;
    
    case 'index':
    default:
        $template = $twig->load('pages/index.twig');
        $data = [
            'lista_gestori' => $vGestori->mostra_lista_gestori(),
            'pagine' => [] // per ora lascio vuoto, ho già i link nella pagina 
        ];
        echo $template->render($data);
        break;        
}

    ################################################
    # CLEANUP
    $pdo = null;