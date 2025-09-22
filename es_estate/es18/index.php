<?php

    // ATTIVA VISUALIZZAZIONE ERRORI (SOLO PER DEBUG)
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    ################################################
    # AUTOLOADER COMPOSER (TWIG E LIBRERIE)
    $loader = require __DIR__ . '/vendor/autoload.php';

    ################################################
    # AUTOLOADER PERSONALIZZATO (CLASSI)
    spl_autoload_register(function ($class_name) {
        $paths = [
            __DIR__ . '/class/',
            __DIR__ . '/class/cliente/',
            __DIR__ . '/class/gestore/',
            __DIR__ . '/class/prenotazione/'
        ];
        
        foreach ($paths as $path) {
            $file = $path . $class_name . '.php';
            if (file_exists($file)) {
                require_once $file;
                return true;
            }
        }
        return false;
    });

    ################################################
    # INCLUDES
    include_once 'inc/DatabaseConnection.php';
    include_once 'class/DatabaseTable.php';

    ################################################
    # CONFIGURAZIONE TWIG
    $loader = new \Twig\Loader\FilesystemLoader('tpl');
    $twig = new \Twig\Environment($loader, ['debug' => true]);
    $twig->addExtension(new \Twig\Extension\DebugExtension());

    ################################################
    # ISTANZE
    //tabelle DB
    $tab_cliente = new DatabaseTable($pdo, 'cliente', 'idc');
    $tab_gestore = new DatabaseTable($pdo, 'gestore', 'idg');
    $tab_prenotazione = new DatabaseTable($pdo, 'prenotazione', 'idp');

    //controllers
    $cCliente = new cCliente($tab_cliente);
    $cGestore = new cGestore($tab_gestore);
    $cPrenotazione = new cPrenotazione($tab_prenotazione, $tab_gestore, $tab_cliente);

    //views 
    $vClienti = new vCliente($tab_cliente);
    $vGestori = new vGestore($tab_gestore);
    $vPrenotazione = new vPrenotazione($tab_prenotazione);
 
    ################################################
    # GESTIONE AZIONI CLIENTE  
    // aggiungi cliente
    if (isset($_POST['azione']) && $_POST['azione'] == 'registra-cliente') {
        $mCliente = new mCliente($_POST['nome'], $_POST['mail']);
        $messaggio = $cCliente->aggiungi_cliente($mCliente);
    }
    // elimina cliente
    if (isset($_POST['azione']) && $_POST['azione'] == 'elimina' &&
        isset($_POST['idc'])) {
            $messaggio = $cCliente->elimina_cliente($_POST['idc']);
    }

    ################################################
    # GESTIONE AZIONI GESTORE
    // aggiungi gestore
    if (isset($_POST['azione']) && $_POST['azione'] == 'registra-gestore') {
        $mGestore = new mGestore($_POST['nome'], $_POST['numero']);
        $messaggio = $cGestore->aggiungi_gestore($mGestore);
    }
    // elimina gestore
    if (isset($_POST['azione']) && $_POST['azione'] == 'elimina' && 
        isset($_POST['idg'])) {
            $messaggio = $cGestore->elimina_gestore($_POST['idg']);
    }

    ################################################
    # GESTIONE DISPONIBILITÀ (FASE 1) - GESTORE REGISTRA SLOT LIBERI
    if (isset($_POST['azione']) && $_POST['azione'] == 'registra-disponibilita'
        && isset($_POST['idg']) && isset($_POST['data']) && isset($_POST['ora'])) {
            $risultato = $cPrenotazione->registra_disponibilita(
                $_POST['idg'], $_POST['data'], $_POST['ora']
            );
    }

    ################################################
    # GESTIONE PRENOTAZIONI (FASE 2) - CLIENTE PRENOTA SLOT DISPONIBILE
    if (isset($_POST['azione']) && $_POST['azione'] == 'prenota'
        && isset($_POST['idp']) && isset($_POST['idc'])) {
            $risultato = $cPrenotazione->prenota_slot_semplice(
                $_POST['idp'], $_POST['idc']
            );
    }

    // elimina prenotazione/disponibilità
    if (isset($_POST['azione']) && $_POST['azione'] == 'elimina' && 
        isset($_POST['idp'])) {
            $messaggio = $cPrenotazione->elimina_prenotazione($_POST['idp']);
    }

    ################################################
    # RENDERING
    $p = isset($_REQUEST['p']) ? $_REQUEST['p'] : 'index';

    switch ($p) {
        case 'clienti':
            $template = $vClienti->carica_tpl_clienti($twig);
            
            $data = [
                'lista_clienti' => $vClienti->mostra_lista_clienti(),
                'disponibilita_libere' => $cPrenotazione->ottieni_disponibilita(),
                'disponibilita_select' => $cPrenotazione->ottieni_disponibilita_per_select(),
                'p' => $p
            ];
            echo $template->render($data);
            break;
        
        case 'gestori':
            $template = $vGestori->carica_tpl_gestori($twig);
            
            $data = [
                'lista_gestori' => $vGestori->mostra_lista_gestori(),
                'disponibilita_gestori' => $cPrenotazione->ottieni_disponibilita(),
                'p' => $p
            ];
            
            echo $template->render($data);
            break;
        
        case 'index':
        default:
            $template = $twig->load('pages/index.twig');
            
            $data = [
                'lista_prenotazioni' => $cPrenotazione->ottieni_prenotazioni_confermate()
            ];
            echo $template->render($data);
            break;
    }

    ################################################
    # CLEANUP
    $pdo = null;