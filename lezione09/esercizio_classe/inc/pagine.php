<?php

    /**
     * qui sono dichiarate le pagine e le logiche valide per tutte le pagine
     */

    $pagine = array(
        'index' => array(
            'contenuto' => array(
                'titolo' => 'elenco cani',
                'h1' => 'inserisci cani',
                'testo' => '',
            ),
            'template' => 'tpl/main.html',
            'include' => 'inc/elenco.gestione.php',
            'include2' => 'inc/elenco.lista.php',
        ),
        'gestione' => array(
            'contenuto' => array(
                'titolo' => 'gestione cani',
                'h1' => 'modifica nominativi cani',
                'testo' => '',
            ),
            'template' => 'tpl/main.html',
            'include' => 'inc/elenco.gestione.php',
            'include2' => 'inc/elenco.lista.php',
        ),
    );

    if (!isset($_REQUEST['p']) || !isset($pagine[$_REQUEST['p']])) {
        $_REQUEST['p'] = 'index';
    }

    $p = $pagine[$_REQUEST['p']];

    $voci = [];
    foreach ($pagine as $key => $value) {
        $voci[] = HTML\tag(
            'a',
            [ 'href' => './' . $key . '.html' ],
            $value['contenuto']['titolo']
        );
    }

    $p['contenuto']['menu'] = HTML\tag( 'p', [], implode( ' | ', $voci ) );
