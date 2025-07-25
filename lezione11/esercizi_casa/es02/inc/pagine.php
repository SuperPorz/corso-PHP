<?php

    $pagine = [

        'crea_piatti' => [
            'contenuto' => [
                'titolo' => 'PIATTI CREATI',
                'h1' => 'Elenco piatti creati',
                'tabella' => '',
                'form' => '',
                'select' => ''
            ],
            'template' => 'tpl/main.html',
            'include' => [
                'opt/ingrediente.modl.php',
                'opt/piatto.modl.php',
                'opt/crea_piatti.modl.php',
                'opt/crea_piatti.ctrl.php',
                'opt/crea_piatti.view.php',
            ]
        ],

        'piatto' => [
            'contenuto' => [
                'titolo' => 'NOME PIATTO',
                'h1' => 'Nomi dei piatti',
                'tabella' => '',
                'form' => '',
                'select' => ''
            ],
            'template' => 'tpl/main.html',
            'include' => [
                'opt/piatto.modl.php',
                'opt/piatto.ctrl.php',
                'opt/piatto.view.php',
            ]
        ],

        'ingrediente' => [
            'contenuto' => [
                'titolo' => 'NOME INGREDIENTE',
                'h1' => 'Elenco ingredienti a disposizione in cucina',
                'tabella' => '',
                'form' => '',
                'select' => ''
            ],
            'template' => 'tpl/main.html',
            'include' => [
                'opt/ingrediente.modl.php',
                'opt/ingrediente.ctrl.php',
                'opt/ingrediente.view.php',
            ]
        ]
    ];

    
    #pagina default
    if (!isset($_REQUEST['p']) || !isset($pagine[$_REQUEST['p']])) {
        
        $_REQUEST['p'] = 'crea_piatti';
    }
    
    # abbreviazione
    $p = $pagine[$_REQUEST['p']];

