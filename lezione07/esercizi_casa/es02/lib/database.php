<?php

    $campi = array(
        'campo1' => 'distanza (in Km)',
        'campo2' => 'velocità (in Km/h)',
    );

    $pagine = array(
        'index' => array(
            'contenuto' => array(
                '{{titolo}}' => 'INDEX',
                '{{h1}}' => 'Benvenuto! Clicca sul link seguente per calcolare il tempo di percorrenza',
                '{{testo}}'=> '<a href="./input.html">CLICCA QUI PER INSERIRE I PARAMETRI</a>',
            ),
            'template' => 'tpl/index.html',
        ),

        'input' => array(
            'contenuto' => array(
                '{{titolo}}' => 'INPUT',
                '{{h1}}' => 'Compila i campi seguenti per calcolare il tempo di percorrenza',
                'include' => 'crea_campi.php',        
            ),
            'template' => 'tpl/input.html',
        ),

        'risultato' => array(
            'contenuto' => array(
                '{{titolo}}' => 'OUTPUT',
                '{{h1}}' => 'Ottimo! Calcolo eseguito!',
                'include' => 'calcolo.php',
            ),
            'template' => 'tpl/generic.html',
        ),

    );


    