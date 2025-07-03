<?php

    #lista pagine disponibili
    $pagine = array (

        'lista_umani' => array (
            'contenuto' => array(

                'titolo' => 'UMANI',
                'h1' => 'Elenco umani registrati',
                'table' => '',
                'form' => '',
            ),
            'template' => 'tpl/main.html',
            'include' => [
                'opt/umani.modl.php',
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
        $_REQUEST['p'] = 'lista_umani';
    }

    
    #scorciatoia
    $p = $pagine[$_REQUEST['p']];