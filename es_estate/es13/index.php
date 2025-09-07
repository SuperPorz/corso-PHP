<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    try {

        # INCLUDES
        include 'inc/DatabaseConnection.php';
        include 'classes/DatabaseTable.php';
        include 'classes/CalcoloViaggi.php';
        require_once 'lib/ext/autoload.php'; // composer


        # CONFIGURAZIONE TWIG
        $loader = new \Twig\Loader\FilesystemLoader('tpl'); // loader
        $twig = new \Twig\Environment($loader); // ambiente
        $template = $twig->load('index.twig'); // caricamento template


        # ISTANZE
        $tab_viaggio = new DatabaseTable($pdo, 'viaggio','idv');
        $viaggi = new Viaggi($tab_viaggio);


        # CALCOLI e AZIONI
        if (isset($_GET['azione']) && isset($_GET['id'])) {
            $viaggi->elimina_viaggio($_GET['id']);
        }
        $lista_viaggi = $tab_viaggio->find_all();
        $consumo_medio = $viaggi->consumo_medio();
        $peggiori5 = $viaggi->viaggi_dispendiosi();
        $totale_km = $viaggi->totale_km();


        # RENDER FINALE
        echo $template->render(
            [
                'lista_viaggi' => $lista_viaggi,
                'consumo_medio' => $consumo_medio,
                'totale_km' => $totale_km,
                'peggiori5' => $peggiori5
            ]
        );
    } 
    catch (PDOException $e){
        echo "Errore: " . $e->getMessage() . "<br>";
        echo "File: " . $e->getFile() . ":" . $e->getLine() . "<br>";
        echo "Trace: <pre>" . $e->getTraceAsString() . "</pre>";
    }

    $pdo = null;