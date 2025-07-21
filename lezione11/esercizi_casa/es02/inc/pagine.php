<?php

    $pagine = [

        'piatti' => [
            'contenuto' => [
                'titolo' => 'PIATTI',
                'h1' => 'Elenco piatti disponibili nel menù',
                'tabella' => '',
                'form' => '',
                'select' => ''
            ],
            'template' => 'tpl/main.html',
            'include' => [
                'opt/ingredienti.modl.php',
                'opt/piatti.modl.php',
                'opt/piatti.ctrl.php',
                'opt/piatti.view.php',
            ]
        ],
        'ingredienti' => [
            'contenuto' => [
                'titolo' => 'INGREDIENTI',
                'h1' => 'Elenco ingredienti a disposizione in cucina',
                'tabella' => '',
                'form' => '',
                'select' => ''
            ],
            'template' => 'tpl/main.html',
            'include' => [
                'opt/ingredienti.modl.php',
                'opt/ingredienti.ctrl.php',
                'opt/ingredienti.view.php',
            ]
        ]
    ];

    
    #pagina default
    if (!isset($_REQUEST['p']) || !isset($pagine[$_REQUEST['p']])) {
        
        $_REQUEST['p'] = 'piatti';
    }
    
    # abbreviazione
    $p = $pagine[$_REQUEST['p']];

