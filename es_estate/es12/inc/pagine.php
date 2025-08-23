<?php

    $pagine = [

        'homepage' => [
            'contenuto' => [
                'titolo' => 'HOMEPAGE',
                'h1' => 'Benvenuto nell\'officina LORENZONI srl!',
                'select' => '',
            ],
            'template' => 'tpl/homepage.html',
            'include' => [
            ]
        ],

        'richiesta_lavorazione' => [
            'contenuto' => [
                'titolo' => 'RICHIESTA LAVORAZIONE',
                'h1' => 'INSERIMENTO RICHIESTA LAVORAZIONE',
                'tabella' => '',
                'form' => '',
                'select' => '',
            ],
            'template' => 'tpl/main.html',
            'include' => [
                'opt/inserimento.modl.php',
                'opt/inserimento.ctrl.php',
                'opt/inserimento.view.php',
            ]
        ],

        'storico_lavorazioni' => [
            'contenuto' => [
                'titolo' => 'STORICO LAVORAZIONI',
                'h1' => 'INSERISCI LA TARGA PER OTTENERE <br> LO STORICO LAVORAZIONI',
                'tabella' => '',
                'form' => '',
                'select' => '',
            ],
            'template' => 'tpl/main.html',
            'include' => [
                'opt/storico.modl.php',
                'opt/storico.ctrl.php',
                'opt/storico.view.php',
            ]
        ],
    ];

    
    #pagina default
    if (!isset($_REQUEST['p']) || !isset($pagine[$_REQUEST['p']])) {
        
        $_REQUEST['p'] = 'homepage';
    }
    
    # abbreviazione
    $p = $pagine[$_REQUEST['p']];