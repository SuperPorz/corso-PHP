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

        'inserimento_lavorazione' => [
            'contenuto' => [
                'titolo' => 'INSERIMENTO LAVORAZIONE',
                'h1' => 'INSERIMENTO LAVORAZIONE',
                'tabella' => '',
                'form' => '',
                'select' => '',
            ],
            'template' => 'tpl/main.html',
            'include' => [
                'opt/inserimento.modl.php',
            ]
        ],

        'gestione_operatori' => [
            'contenuto' => [
                'titolo' => 'GESTIONE OPERATORI OFFICINA',
                'h1' => 'GESTIONE OPERATORI OFFICINA',
                'tabella' => '',
                'form' => '',
                'select' => '',
            ],
            'template' => 'tpl/main.html',
            'include' => [
                'opt/operatori.modl.php',
            ]
        ],

        'storico_lavorazioni' => [
            'contenuto' => [
                'titolo' => 'STORICO LAVORAZIONI',
                'h1' => 'INSERISCI LA TARGA PER OTTENERE 
                            <br> LO STORICO LAVORAZIONI',
                'tabella' => '',
                'form' => '',
                'select' => '',
            ],
            'template' => 'tpl/main.html',
            'include' => [
                'opt/storico.modl.php',
            ]
        ],
    ];

    
    #pagina default
    if (!isset($_REQUEST['p']) || !isset($pagine[$_REQUEST['p']])) {
        
        $_REQUEST['p'] = 'homepage';
    }
    
    # abbreviazione
    $p = $pagine[$_REQUEST['p']];