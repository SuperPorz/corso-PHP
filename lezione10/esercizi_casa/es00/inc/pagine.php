<?php

    #lista pagine disponibili
    $pagine = array (

        'homepage' => array (
            'contenuto' => array(

                'titolo' => 'HOMEPAGE',
                'h1' => 'Elenco umani registrati',
                'table' => '',
                'form' => '',
            ),
            'template' => 'tpl/main.html',
            'include' => [
                'opt/umani.modl.php',
                'opt/homepage.view.php',
            ]
        ),
        'modifica_umani' => array (
            'contenuto' => array(

                'titolo' => 'UMANI',
                'h1' => 'Modifica umani registrati',
                'table' => '',
                'form' => '',
            ),
            'template' => 'tpl/main.html',
            'include' => [
                'opt/umani.modl.php',
                'opt/log.modl.php',
                'opt/umani.ctrl.php',
                'opt/umani.view.php',
            ]
        ),
        'log_operazioni' => array (
            'contenuto' => array(

                'titolo' => 'LOG',
                'h1' => 'Storico delle operazioni sul DB:',
                'table' => '',
                'form' => '',
            ),
            'template' => 'tpl/main.html',
            'include' => [
                'opt/log.modl.php',
                'opt/log.ctrl.php',
                'opt/log.view.php',
            ]
        )
    );
    
    #spagina default
    if (!isset($_REQUEST['p']) || !isset($pagine[$_REQUEST['p']])) {
        $_REQUEST['p'] = 'homepage';
    }

    
    #scorciatoia
    $p = $pagine[$_REQUEST['p']];