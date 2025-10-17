<?php

    ################################################
    # INCLUDES e IMPORT

    require_once '../res/ext/autoload.php';

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
        // Ricarica le vendite dopo la modifica
        /* $vendite = VenditeController::elenco_vendite(); */
    }

    // elimina vendita
    if (isset($_POST['azione']) && $_POST['azione'] == 'elimina' && isset($_POST['idv'])) {
        VenditeController::elimina_vendita($_POST['idv']);
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