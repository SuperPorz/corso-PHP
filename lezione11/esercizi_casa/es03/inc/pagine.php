<?php

    $pagine = [

        'homepage' => [
            'contenuto' => [
                'titolo' => 'HOMEPAGE',
                'h1' => 'Benvenuto alla trattoria LORENZONI MARI & MONTI!',
                'select' => '',
                'sezione1' => '<h2>SEZIONE 1: AGGIUNGI INGREDIENTI/CREA PIATTI</h2>
                                <h3>Aggiungi ingredienti, poi crea piatti:</h3>
                                <ul>
                                    <li><a href="ingrediente.html">INGREDIENTE</a> (aggiungi/modifica/elimina ingrediente)</li>
                                    <li><a href="piatto.html">PIATTO</a> (aggiungi/modifica/elimina piatto)</li>
                                </ul>
                                <h3>Leggi i menù creati:</h3>
                                <ul>
                                    <li><a href="crea_piatti.html">PIATTO => INGREDIENTI</a> (associa piatti con ingredienti)</li>
                                    <li><a href="uso_ingrediente.html">INGREDIENTE => PIATTI</a> (per ciascun ingrediente, visualizza piatti associati)</li>
                                </ul>',
                'sezione2' => '<h2>SEZIONE 2: SUGGERISCI MENU/LISTA DELLA SPESA</h2>
                                <h3>Individua quali piatti puoi creare con gli ingredienti a tua disposizione:</h3>
                                <ul>
                                    <li><a href="piatti_preparabili.html">PIATTI PREPARABILI</a></li>
                                </ul>
                                <h3>Oppure scegli uno dei nostri menù e ottieni la relativa lista della spesa:</h3>
                                <ul>
                                <li><a href="lista_spesa.html">MENU\' e LISTA SPESA</a></li>
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
                'info' => '<h4>(se non associato a nessun ingrediente, il piatto non verrà visualizzato)</h4>',
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
                'info' => '',
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
                'info' => '<h4>(se non associato a nessun ingrediente, il piatto non verrà visualizzato)</h4>'
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
                'info' => '<h4>(se non associato a nessun piatto, l\'ingrediente non verrà visualizzato)</h4>'
            ],
            'template' => 'tpl/main.html',
            'include' => [
                'opt/ingrediente.modl.php',
                'opt/piatto.modl.php',
                'opt/uso_ingrediente.modl.php',
                'opt/uso_ingrediente.view.php',
            ]
        ],

        'piatti_preparabili' => [
            'contenuto' => [
                'titolo' => 'PIATTI PREPARABILI',
                'h1' => 'Seleziona ingredienti a disposizione: individua quali piatti preparare',
                'tabella' => '',
                'form' => '',
                'select' => '',
                'info' => '<h4>(se non associato a nessun piatto, l\'ingrediente non sarà disponibile in elenco)</h4>'
            ],
            'template' => 'tpl/main.html',
            'include' => [
                'opt/uso_ingrediente.modl.php',
                'opt/piatto.modl.php',
                'opt/piatti_preparabili.modl.php',
                'opt/piatti_preparabili.view.php',
            ]
        ],

        'lista_spesa' => [
            'contenuto' => [
                'titolo' => 'LISTA SPESA',
                'h1' => 'Seleziona un piatto',
                'tabella' => '',
                'form' => '',
                'select' => '',
                'info' => '<h4>(piatti ed ingredienti non abbinati, non saranno visualizzabili)</h4>'
            ],
            'template' => 'tpl/lista_spesa.main.html',
            'include' => [
                'opt/crea_piatti.modl.php',
                'opt/piatto.modl.php',
                'opt/lista_spesa.modl.php',
                'opt/lista_spesa.view.php',
            ]
        ],
    ];

    
    #pagina default
    if (!isset($_REQUEST['p']) || !isset($pagine[$_REQUEST['p']])) {
        
        $_REQUEST['p'] = 'homepage';
    }
    
    # abbreviazione
    $p = $pagine[$_REQUEST['p']];

