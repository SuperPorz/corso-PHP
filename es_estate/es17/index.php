<?php

    # INCLUDES
    include 'inc/DatabaseConnection.php';
    include 'classes/DatabaseTable.php';
    include 'classes/SelezioneArticoli.php';
    include 'classes/ComponiRivista.php';
    include 'classes/Controllers.php';
    require_once 'lib/ext/autoload.php';

    ################################################
    # CONFIGURAZIONE TWIG
    $loader = new \Twig\Loader\FilesystemLoader('tpl');
    $twig = new \Twig\Environment($loader);

    ################################################
    # ISTANZE CONTROLLER
    $tab_articolo = new DatabaseTable($pdo, 'articolo', 'ida');
    $ctrl_articoli = new ControllerArticoli($tab_articolo);
    $obj_riviste = new ComponiRivista($tab_articolo);
    $ctrl_riviste = new ControllerRiviste($obj_riviste);

    ################################################
    # GESTIONE AZIONI
    $ctrl_articoli->gestione_azioni_articoli();
    $array_riviste = $ctrl_riviste->gestione_azioni_riviste();

    ################################################
    # RENDERING TEMPLATE
    $ctrl_template = new ControllerTemplate($twig, $array_riviste);
    echo $ctrl_template->render();

    ################################################
    # CLEANUP
    $pdo = null;