<?php

    $pagine = [

        'homepage' => [
            'contenuto' => [
                'titolo' => 'HOMEPAGE',
                'h1' => 'Benvenuto alla trattoria LORENZONI MARI & MONTI!',
                'tabella' => '',
                'form' => '',
                'select' => '',
                'sottomenu' => '<h3>Inizia inserendo un PIATTO oppure un INGREDIENTE:</h3>
                                <ul>
                                    <li><a href="piatto.html">PIATTO</a></li>
                                    <li><a href="ingrediente.html">INGREDIENTE</a></li>
                                </ul>
                                <h3>Oppure vai alle associazioni PIATTI/INGREDIENTI:</h3>
                                <ul>
                                <li><a href="crea_piatti.html">PIATTO => INGREDIENTI</a></li>
                                <li><a href="uso_ingrediente.html">INGREDIENTE => PIATTI</a></li>
                                </ul>'
            ],
            'template' => 'tpl/homepage.html',
            'include' => [
            ]
        ],

        'piatto' => [
            'contenuto' => [
                'titolo' => 'NOME PIATTO',
                'h1' => 'Nomi dei piatti',
                'tabella' => '',
                'form' => '',
                'select' => '',
                'sottomenu' => '<h3>Procedi con:</h3>
                                <ul>
                                    <li><a href="ingrediente.html">INGREDIENTE</a></li>
                                    <li><a href="crea_piatti.html">PIATTO => INGREDIENTI</a></li>
                                    <li><a href="uso_ingrediente.html">INGREDIENTE => PIATTI</a></li>
                                </ul>'
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
                'select' => '',
                'sottomenu' => '<h3>Procedi con:</h3>
                                <ul>
                                    <li><a href="piatto.html">PIATTO</a></li>
                                    <li><a href="crea_piatti.html">PIATTO => INGREDIENTI</a></li>
                                    <li><a href="uso_ingrediente.html">INGREDIENTE => PIATTI</a></li>
                                </ul>'
            ],
            'template' => 'tpl/main.html',
            'include' => [
                'opt/ingrediente.modl.php',
                'opt/ingrediente.ctrl.php',
                'opt/ingrediente.view.php',
            ]
        ],

        'crea_piatti' => [
            'contenuto' => [
                'titolo' => 'PIATTI CREATI',
                'h1' => 'Elenco piatti creati',
                'tabella' => '',
                'form' => '',
                'select' => '',
                'sottomenu' => '<h4>(se non associato a nessun ingrediente, il piatto non verrà visualizzato)</h4>'
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

        'uso_ingrediente' => [
            'contenuto' => [
                'titolo' => 'USO INGREDIENTI',
                'h1' => 'Visualizza ciascun ingrediente ed in quale piatto è utilizzato',
                'tabella' => '',
                'form' => '',
                'select' => '',
                'sottomenu' => '<h4>(se non associato a nessun piatto, l\'ingrediente non verrà visualizzato)</h4>'
            ],
            'template' => 'tpl/main.html',
            'include' => [
                'opt/ingrediente.modl.php',
                'opt/piatto.modl.php',
                'opt/uso_ingrediente.modl.php',
                'opt/uso_ingrediente.view.php',
            ]
        ],
    ];

    
    #pagina default
    if (!isset($_REQUEST['p']) || !isset($pagine[$_REQUEST['p']])) {
        
        $_REQUEST['p'] = 'homepage';
    }
    
    # abbreviazione
    $p = $pagine[$_REQUEST['p']];

