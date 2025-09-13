<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

    try {

        # INCLUDES
        include 'inc/DatabaseConnection.php';
        include 'classes/DatabaseTable.php';
        include 'classes/GestioneConcerti.php';
        require_once 'lib/ext/autoload.php'; // composer


        # CONFIGURAZIONE TWIG
        $loader = new \Twig\Loader\FilesystemLoader('tpl'); // loader
        $twig = new \Twig\Environment($loader); // ambiente
        $template = $twig->load('index.twig'); // caricamento template


        # ISTANZE
        $tab_musicista = new DatabaseTable($pdo, 'musicista','idm');
        $tab_utente = new DatabaseTable($pdo, 'utente','idu');
        $tab_preferenza = new DatabaseTable($pdo, 'preferenza','idp');
        $organizzazione = new GestioneConcerto(
                $tab_musicista, $tab_utente, $tab_preferenza);


        # INSERIMENTI/ELIMINAZIONI DATI DAL DB
        // inserimenti
        if (isset($_POST['nome']) && isset($_POST['compenso'])) {
            $organizzazione->registra_musicista(
                $_POST['nome'], $_POST['compenso']);
        }
        if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['preferenza'])) {
            $organizzazione->registra_utente(
                $_POST['nome'], $_POST['email'], $_POST['preferenza']);
        }

        // eliminazioni
        if (isset($_GET['azione']) && isset($_GET['idm'])) {
            $organizzazione->elimina_musicista($_GET['idm']);
        }
        if (isset($_GET['azione']) && isset($_GET['idu'])) {
            $organizzazione->elimina_utente($_GET['idu']);
        }


        # QUERY AL DATABASE E CALCOLI
        $musicisti_registrati = $tab_musicista->find_all();
        $utenti_registrati = $tab_utente->find_all();
        $statistiche_database = $organizzazione->statistiche_database();
        $statistiche_generali = $organizzazione->statistiche_generali();
        $top_concerti = $organizzazione->concerti_profittevoli();


        # RENDER FINALE
        echo $template->render(
            [
                'musicisti_registrati' => $musicisti_registrati,
                'utenti_registrati' => $utenti_registrati,
                'statistiche_database' => $statistiche_database,
                'statistiche_generali' => $statistiche_generali,
                'top_concerti' => $top_concerti
            ]
        );
    } 
    catch (PDOException $e){
        echo "Errore: " . $e->getMessage() . "<br>";
        echo "File: " . $e->getFile() . ":" . $e->getLine() . "<br>";
        echo "Trace: <pre>" . $e->getTraceAsString() . "</pre>";
    }

    $pdo = null;