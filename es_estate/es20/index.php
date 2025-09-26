<?php

    ################################################
    # INCLUDES BASE
    include_once 'inc/DatabaseConnection.php';
    include_once 'inc/DatabaseTable.php';


    ################################################
    # INCLUDES CLASSI
    //auto
    foreach (glob("class/auto/*.php") as $file) {
        require_once $file;
    }
    //parcheggio
    foreach (glob("class/parcheggio/*.php") as $file) {
        require_once $file;
    }
    //sosta
    foreach (glob("class/sosta/*.php") as $file) {
        require_once $file;
    }


    ################################################
    # ISTANZE
    //tabelle DB
    $tab_auto = new DatabaseTable($pdo, 'auto', 'ida');
    $tab_parcheggio = new DatabaseTable($pdo, 'parcheggio', 'idp');
    $tab_sosta = new DatabaseTable($pdo, 'sosta', 'ids');   

    //controllers

    //views

    ################################################
    # GESTIONE AZIONI  
    // aggiungi auto
    if (isset($_POST['azione']) && $_POST['azione'] == 'registra-auto') {
        $auto = new mAuto($_POST['targa'], $_POST['proprietario']);
        $cAuto->aggiungi_auto($auto);
    }

    // elimina auto
    if (isset($_POST['azione']) && $_POST['azione'] == 'elimina-auto' && 
        isset($_POST['ida'])) {
        $cAuto->elimina_auto($_POST['ida']);
    }

    // aggiungi parcheggio
    if (isset($_POST['azione']) && $_POST['azione'] == 'registra-parcheggio') {
        $parcheggio = new mParcheggio($_POST['nome'], floatval($_POST['tariffa']));
        $cParcheggio->aggiungi_parcheggio($parcheggio);
    }

    // elimina parcheggio
    if (isset($_POST['azione']) && $_POST['azione'] == 'elimina-parcheggio' && 
        isset($_POST['idp'])) {
        $cParcheggio->elimina_parcheggio($_POST['idp']);
    }

    // inizia sosta
    if (isset($_POST['azione']) && $_POST['azione'] == 'inizia' && 
        isset($_POST['ida']) && isset($_POST['idp'])) {
        $cSosta->inizia_sosta($_POST['ida'], $_POST['idp']);
    }

    // termina sosta
    if (isset($_POST['azione']) && $_POST['azione'] == 'termina' && 
        isset($_POST['ids'])) {
        $cSosta->termina_sosta($_POST['ids']);
    }


    ################################################
    # RENDERING
    $p = isset($_REQUEST['p']) ? $_REQUEST['p'] : 'index';

    switch ($p) {
        case 'auto':
            echo $vAuto->render_auto();
            break;

        case 'parcheggio':
            if(isset($_POST['azione']) && $_POST['azione'] == 'soste_select'
            && isset($_POST['idp'])) {
                echo $vParcheggio->render_parcheggio(isset($_POST['idp']));
            }
            else {
                echo $vParcheggio->render_parcheggio(''); //se IDP non settato, render normale, non si chiama la funz. per la tabella
            }
            break;
        
        case 'soste':
            echo $vSosta->render_soste();
            break;
        
        default:
            $render = file_get_contents('tpl/index.html');
            echo $render;
            break;
    }


    ################################################
    # CLEANUP
    $pdo = null;