<?php

    # INCLUDES
    include '../src/DatabaseConnection.php';
    include '../src/DatabaseTable.php';


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
        header('Location: public/index.html');
    } 

    //modifica 1 - popola form
    if (isset($_POST['azione']) && $_POST['azione'] == 'modifica' && isset($_POST['idn'])) {
        $dati = [$_POST['idn'], $_POST['titolo'], $_POST['testo']];
        $tab_notizie->save($dati);
        header('Location: public/index.html');
    }

    //modifica 2 - invia al DB
    if (isset($_POST['azione']) && $_POST['azione'] == 'modifica' && isset($_POST['idn'])) {
        $dati = [$_POST['idn'], $_POST['titolo'], $_POST['testo']];
        $tab_notizie->save($dati);
        header('Location: public/index.html');
    }

    //eliminazione
    if (isset($_POST['azione']) && $_POST['azione'] == 'elimina' && isset($_POST['idn'])) {
        $tab_notizie->delete($_POST['idn']);
        header('Location: public/index.html');
    }


    # CLEANUP
    $pdo = null;