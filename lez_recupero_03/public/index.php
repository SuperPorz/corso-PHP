<?php

    ################################################
    # INCLUDES e IMPORT
    require_once '../res/ext/autoload.php';
    require_once '../api/php/api_proxy.php';

    foreach (glob("../res/inc/*.php") as $file) {
        require_once $file;
    }
    foreach (glob("../res/*.php") as $file) {
        require_once $file;
    }

    use Model\VenditeModel;

    ################################################
    # CONFIGURAZIONE TWIG
    $loader = new \Twig\Loader\FilesystemLoader('tpl'); // loader
    $twig = new \Twig\Environment($loader); // ambiente
    $template = $twig->load('main.twig'); // caricamento template


    ################################################
    # ISTANZE
    //tabelle DB
    $tab_vendite = new VenditeModel($pdo, 'vendite', 'idv');
    VenditeController::init($tab_vendite); //nuovo modo: classe statica


    ################################################
    # GESTIONE AZIONI 
    // inserisci vendita
    if (isset($_POST['azione']) && $_POST['azione'] == 'inserisci') {
        $array = [
            'agente' => $_POST['agente'],
            'data' => $_POST['data'],
            'importo' => $_POST['importo'],
            'provvigione' => $_POST['provvigione'] ?? null
        ];
        VenditeController::inserisci_vendita($array);
    }

    // modifica vendita (richiesta);
    if (isset($_POST['azione']) && $_POST['azione'] == 'modifica') {
        $vendita_edit = VenditeController::cerca_vendita($_POST['idv']);
    }

    // modifica vendita (conferma)
    if (isset($_POST['azione']) && $_POST['azione'] == 'conferma_modifica') {
        $array = [
            'idv' => $_POST['idv'], // ← IMPORTANTE: includi l'ID per l'update
            'agente' => $_POST['agente'],
            'data' => $_POST['data'],
            'importo' => $_POST['importo'],
            'provvigione' => $_POST['provvigione'] ?? null
        ];
        VenditeController::modifica_vendita($array);
    }

    // elimina vendita
    if (isset($_POST['azione']) && $_POST['azione'] == 'elimina' && isset($_POST['idv'])) {
        VenditeController::elimina_vendita($_POST['idv']);
    }


    ################################################
    #   CHIAMATA API - CALCOLA PROVVIGIONI
    // Calcola provvigioni (nuova azione)
    if (isset($_GET['azione']) && $_GET['azione'] == 'calcola_provvigioni') {
        $result = ApiProxy::calcolaProvvigioni();
        
        if ($result['success']) {
            echo "<script>alert('" . $result['message'] . "');</script>";
            // Ricarica le vendite per mostrare i cambiamenti
            $vendite = VenditeController::elenco_vendite();
        } else {
            echo "<script>alert('Errore: " . $result['error'] . "');</script>";
        }
    }


    ################################################
    # RENDERING
    $vendite = VenditeController::elenco_vendite();
    echo $template->render(
        [
            'vendite' => $vendite,
            'vendita_mod' => $vendita_edit ?? '',
            'azione' => $_POST['azione'] ?? ''
        ]
    );


    ################################################
    # CLEANUP
    $pdo = null;