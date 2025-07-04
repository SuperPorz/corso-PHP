<?php

    #lista pagine disponibili
    $pagine = array (

        'lista_cani' => array (
            'contenuto' => array(

                'titolo' => 'CANI',
                'h1' => 'Elenco cani registrati',
                'table' => '',
                'form' => '',
            ),
            'template' => 'tpl/main.html',
            'include' => [
                'opt/cani.modl.php',
                'opt/cani.ctrl.php',
                'opt/cani.view.php',
            ]
        )
    );
    
    #spagina default
    if (!isset($_REQUEST['p']) || !isset($pagine[$_REQUEST['p']])) {
        $_REQUEST['p'] = 'lista_cani';
    }

    #scorciatoia
    $p = $pagine[$_REQUEST['p']];