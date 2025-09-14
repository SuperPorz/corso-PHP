<?php

    try {

        # INCLUDES
        include 'inc/DatabaseConnection.php';
        include 'classes/DatabaseTable.php';
        include 'classes/BasketStats.php';
        require_once 'lib/ext/autoload.php';


        # CONFIGURAZIONE TWIG
        $loader = new \Twig\Loader\FilesystemLoader('tpl'); // loader
        $twig = new \Twig\Environment($loader); // ambiente
        $template = $twig->load('index.twig'); // caricamento template


        # ISTANZE
        $tab_giocatore = new DatabaseTable($pdo, 'giocatore','idg');
        $statistiche = new BasketStats($tab_giocatore);


        # INSERIMENTI/ELIMINAZIONI DATI DAL DB
        // inserimenti
        if (isset($_POST['azione']) && $_POST['azione'] == 'registra') {
            $statistiche->registra_giocatore(
                $_POST['nome'], 
                $_POST['ruolo'], 
                $_POST['punti'], 
                $_POST['rimbalzi'], 
                $_POST['assist'], 
                $_POST['resistenza'],
                $_POST['palle_perse'], 
                $_POST['falli']);
        }

        // eliminazioni
        if (isset($_GET['azione']) && isset($_GET['idg'])) {
            $statistiche->elimina_giocatore($_GET['idg']);
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