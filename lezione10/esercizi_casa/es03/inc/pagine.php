<?php

    #lista pagine disponibili
    $pagine = array (

        'lista_cani' => array (
            'contenuto' => array(

                'titolo' => 'CANI',
                'h1' => 'Elenco cani registrati',
                'table' => '',
                'form' => '',
                'select' => '',
            ),
            'template' => 'tpl/main.html',
            'include' => [
                'opt/padroni.modl.php',
                'opt/cani.modl.php',
                'opt/cani.ctrl.php',
                'opt/cani.view.php',
            ]
            ),
            'lista_padroni' => array (
            'contenuto' => array(

                'titolo' => 'PADRONI',
                'h1' => 'Elenco padroni',
                'table' => '',
                'form' => '',
                'select' => '',
            ),
            'template' => 'tpl/main.html',
            'include' => [
                'opt/padroni.modl.php',
                'opt/padroni.ctrl.php',
                'opt/padroni.view.php',
            ]
        ),
            'vaccinazioni_scadute' => array (
            'contenuto' => array(

                'titolo' => 'VACCINAZIONI SCADUTE',
                'h1' => 'Elenco cani con vaccinazioni scadute ed elenco padroni da contattare',
                'table' => '',
                'form' => '',
                'select' => '',
            ),
            'template' => 'tpl/main.html',
            'include' => [
                'opt/scadenze.modl.php',
                'opt/scadenze.view.php',
            ]
        )
    );
    
    #spagina default
    if (!isset($_REQUEST['p']) || !isset($pagine[$_REQUEST['p']])) {
        $_REQUEST['p'] = 'lista_padroni';
    }

    #scorciatoia
    $p = $pagine[$_REQUEST['p']];