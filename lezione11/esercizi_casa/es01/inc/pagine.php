<?php

    $pagine = [

        'piatti' => [
            'contenuto' => [
                'titolo' => 'PIATTI',
                'h1' => 'Elenco piatti disponibili nel menù',
                'tabella' => '',
                'form' => ''
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
                'form' => ''
            ],
            'template' => 'tpl/main.html',
            'include' => [
                'opt/ingredienti.modl.php',
                'opt/piatti.modl.php',
                'opt/piatti.ctrl.php',
                'opt/piatti.view.php',
            ]
        ]
    ];

    # abbreviazione
    $p = $pagine[$_REQUEST['p']];

    #pagina default
    if (isset($_REQUEST['p']) && empty($_REQUEST['p'])) {

        $_REQUEST['p'] = 'piatti';
    }


