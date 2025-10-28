<?php

    # INCLUDES
    include '../src/DatabaseConnection.php';
    include '../src/DatabaseTable.php';


    # LIBRERIA
    function render($tpl, $dati) {
        $contenuto = file_get_contents($tpl);
        foreach ($dati as $k => $v) {
            $contenuto = str_replace('{{' . $k . '}}', $v, $contenuto);
        }
        return $contenuto;
    }


    # ISTANZE
    $tab_notizie = new DatabaseTable($pdo, 'notizie', 'idn');


    # GESTIONE AZIONI
    //inserimento
    if (isset($_POST['azione']) && $_POST['azione'] == 'inserisci') {
        $dati = [
            'titolo' => $_POST['titolo'], 
            'testo' => $_POST['testo']
        ];
        $tab_notizie->save($dati);
        header('Location: index.php');
    } 

    //modifica 1 - popola form
    if (isset($_POST['azione']) && $_POST['azione'] == 'modifica' && isset($_POST['idn'])) {
        $dati = [$_POST['idn'], $_POST['titolo'], $_POST['testo']];
        $tab_notizie->save($dati);
        header('Location: index.php');
    }

    //modifica 2 - invia al DB
    if (isset($_POST['azione']) && $_POST['azione'] == 'modifica' && isset($_POST['idn'])) {
        $dati = [$_POST['idn'], $_POST['titolo'], $_POST['testo']];
        $tab_notizie->save($dati);
        header('Location: index.php');
    }

    //eliminazione
    if (isset($_POST['azione']) && $_POST['azione'] == 'elimina' && isset($_POST['idn'])) {
        $tab_notizie->delete($_POST['idn']);
        header('Location: index.php');
    }

    # COSTRUZIONE TABELLA
    $righe_tabella = [];
    foreach($tab_notizie->find_all() as $notizia) {

        $righe_tabella[] = render('./tpl/table-list.html',
        [
            'idn' => $notizia['idn'],
            'titolo' => $notizia['titolo'],
            'testo' => $notizia['testo'],
            ]
        );
    }

    
    # RENDER FINALE
    $render = render('./tpl/index.html',
        ['interventi_registrati' => implode($righe_tabella)]);
    echo $render;


    # CLEANUP
    $pdo = null;