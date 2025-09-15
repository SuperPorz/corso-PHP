<?php

    try {

        # INCLUDES
        include 'inc/DatabaseConnection.php';
        include 'classes/DatabaseTable.php';
        include 'classes/Articolo.php';
        require_once 'lib/ext/autoload.php';


        # CONFIGURAZIONE TWIG
        $loader = new \Twig\Loader\FilesystemLoader('tpl'); // loader
        $twig = new \Twig\Environment($loader); // ambiente
        $template = $twig->load('index.twig'); // caricamento template


        # ISTANZE INIZIALI
        $tab_articolo = new DatabaseTable($pdo, 'articolo','ida');
        $redazione = new RedazioneGiornale($tab_articolo);


        # INSERIMENTI/MODIFICHE/ELIMINAZIONI DATI DAL DB
        // inserisci articolo
        if (isset($_POST['azione']) && $_POST['azione'] == 'registra') {
            $redazione->registra_articolo(
                $_POST['autore'], 
                $_POST['titolo'], 
                $_POST['argomento'], 
                $_POST['testo'], 
                $_POST['lunghezza'], 
            );
        }

        // modifica articolo
        if (isset($_GET['azione']) && isset($_GET['ida'])) {
            $redazione->modifica_articolo(
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
            $redazione->elimina_articolo($_GET['ida']);
        }


        # CALCOLI: USO METODO DELLA CLASSE 'MAIN PROGRAM'
        $risultati = $statistiche->main_program();


        # RENDER FINALE
        echo $template->render(
            [
                'lista_giocatori' => $tab_giocatore->find_all(),
                'giocatori_per_ruolo' => $risultati[0],
                'top5' => $risultati[1],
                'sostituzioni' => $risultati[2],
            ]
        );

        //print_r($risultati[2]);
    } 
    catch (PDOException $e){
        echo "Errore: " . $e->getMessage() . "<br>";
        echo "File: " . $e->getFile() . ":" . $e->getLine() . "<br>";
        echo "Trace: <pre>" . $e->getTraceAsString() . "</pre>";
    }

    $pdo = null;