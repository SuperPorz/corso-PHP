<?php

    try {

        # INCLUDES
        include 'inc/DatabaseConnection.php';
        include 'classes/DatabaseTable.php';
        include 'classes/ControllerArticoli.php';
        include 'classes/SelezioneArticoli.php';
        include 'classes/ComponiRivista.php';
        require_once 'lib/ext/autoload.php';


        ################################################
        # CONFIGURAZIONE TWIG (template caricato successivamente)
        $loader = new \Twig\Loader\FilesystemLoader('tpl'); // loader
        $twig = new \Twig\Environment($loader); // ambiente


        ################################################
        # ISTANZE INIZIALI
        $tab_articolo = new DatabaseTable($pdo, 'articolo','ida');
        $ctrl_articoli = new ControllerArticoli($tab_articolo);
        $select_articoli = new SelezioneArticoli($tab_articolo);


        ################################################
        # INSERIMENTI/MODIFICHE/ELIMINAZIONI DATI DAL DB
        // inserisci articolo
        if (isset($_POST['azione']) && $_POST['azione'] == 'registra') {
            $ctrl_articoli->registra_articolo(
                $_POST['autore'], 
                $_POST['titolo'], 
                $_POST['argomento'], 
                $_POST['testo'], 
                $_POST['lunghezza'], 
            );
        }

        // modifica articolo
        if (isset($_GET['azione']) && isset($_GET['ida'])) {
            $ctrl_articoli->modifica_articolo(
                $_GET['ida'], 
                $_POST['autore'], 
                $_POST['titolo'], 
                $_POST['argomento'], 
                $_POST['testo'], 
                $_POST['lunghezza'],
            );
        }

        // elimina articolo
        if (isset($_GET['azione']) && isset($_GET['ida'])) {
            $ctrl_articoli->elimina_articolo($_GET['ida']);
        }

        ################################################
        # CREAZIONE NUMERI RIVISTE PIANIFICATE
        if (isset($_POST['numeri']) && is_numeric($_POST['numeri'])) {

            $obj_riviste = new ComponiRivista($tab_articolo);
            $array_riviste = $obj_riviste->componi_riviste($_POST['numeri']);
            $riviste = $obj_riviste->scrittura($array_riviste);
        }
        else {
            $obj_riviste = new ComponiRivista($tab_articolo);
            $riviste = $obj_riviste->lettura();
        }

        ################################################
        # ELIMINAZIONE RIVISTE
        if (isset($_GET['azione']) &&  $_GET['azione'] == 'elimina') {
            $obj_riviste->elimina_temp_db();
        }


        ################################################
        # CRICAMENTO TEMPLATE TWIG CORRETTO
        $p = $_REQUEST['p'];
        if ($p == 'index' || empty($p)) {
            $template = $twig->load('index.twig'); // template DEFAULT
        }
        else {
            $template = $twig->load('magazine.twig'); // template RIVISTE
        }


        ################################################
        # RENDER FINALE
        echo $template->render(
            [
                'riviste' => $riviste,
            ]
        );
    } 
    catch (PDOException $e){
        echo "Errore: " . $e->getMessage() . "<br>";
        echo "File: " . $e->getFile() . ":" . $e->getLine() . "<br>";
        echo "Trace: <pre>" . $e->getTraceAsString() . "</pre>";
    }

    $pdo = null;




    