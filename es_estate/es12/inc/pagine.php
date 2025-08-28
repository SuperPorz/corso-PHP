<?php

    $pagine = [

        'homepage' => [
            'contenuto' => [
                'titolo' => 'HOMEPAGE',
                'ul' => file_get_contents('tpl/ul.menu.html'),
                'h1' => 'Benvenuto nell\'officina LORENZONI GmbH!',
            ],
            'template' => 'tpl/homepage.html',
        ],

        'lavorazioni' => [
            'contenuto' => [
                'titolo' => 'INSERIMENTO LAVORAZIONE',
                'ul' => file_get_contents('tpl/ul.menu.html'),
                'h1' => 'INSERIMENTO LAVORAZIONI DISPONIBILI IN OFFICINA',
                'h2a' => 'Inserisci una possibile lavorazione:',
                'form' => '',
                'h2b' => 'Lavorazioni attualmente disponibili:',
                'tabella' => '',
            ],
            'template' => 'tpl/main.html',
        ],

        'operatori' => [
            'contenuto' => [
                'titolo' => 'GESTIONE OPERATORI OFFICINA',
                'ul' => file_get_contents('tpl/ul.menu.html'),
                'h1' => 'INSERIMENTO OPERATORI DELL\'OFFICINA',
                'h2a' => 'Inserisci il nominativo di un operatore autorizzato:',
                'form1' => '',               
                'h2b' => 'Inserisci il tempo di lavorazione di ciascun operaio:',
                'form2' => '',
                'select_lavorazione' => '',
                'select_operatore' => '',
                'h2c' => 'Operatori attualmente disponibili:',
                'tabella1' => '',
                'h2d' => 'Tempistiche lavorazioni per operaio:',
                'tabella2' => '',
            ],
            'template' => 'tpl/special.html',
        ],

        'officina' => [
            'contenuto' => [
                'titolo' => 'OFFICINA & STORICO',
                'ul' => file_get_contents('tpl/ul.menu.html'),
                'h1' => 'GESTIONE OFFICINA e STORICO LAVORAZIONI',
                'h2a' => 'Richiedi un intervento per la tua auto:',
                'form1' => '',                
                'select_lavorazione' => '',
                'select_operatore' => '',
                'h2b' => 'Inserisci la tua targa per vederne lo storico:',
                'form2' => '',
                'h2c' => 'Storico lavorazioni per la targa inserita:',
                'tabella1' => '',
                'h2d' => 'Dati officina:',
                'tabella2' => '',
            ],
            'template' => 'tpl/special.html',
        ],
    ];

    
    #pagina default
    if (!isset($_REQUEST['p']) || !isset($pagine[$_REQUEST['p']])) {
        
        $_REQUEST['p'] = 'homepage';
    }
    
    # abbreviazione
    $p = $pagine[$_REQUEST['p']];