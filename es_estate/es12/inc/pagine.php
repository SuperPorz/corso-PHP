<?php

    $pagine = [

        'homepage' => [
            'contenuto' => [
                'titolo' => 'HOMEPAGE',
                'h1' => 'Benvenuto nell\'officina LORENZONI GmbH!',
                'azzera' => 'href="homepage"'
            ],
            'template' => 'tpl/homepage.html',
        ],

        'officina' => [
            'contenuto' => [
                'titolo' => 'OFFICINA & STORICO',
                'h1' => 'GESTIONE OFFICINA e STORICO LAVORAZIONI',
                'h2a' => 'Storico globale lavorazioni officina:',
                'tabella1' => '',
                'h2b' => 'Inserisci lavorazione per auto:',
                'form1' => file_get_contents('tpl/forms/officina.lavorazione.form.html'),
                'h2c' => 'Inserisci la tua targa per vederne lo storico:',
                'form2' => file_get_contents('tpl/forms/officina.storico.form.html'),
                'h2d' => 'Storico lavorazioni per la targa inserita:',
                'tabella2' => '',
                'h3' => 'Spesa totale per la targa selezionata:',
                'spesa_totale' => '',
                'h2e' => 'Migliori operatori:',
                'tabella3' => '',
                'h2f' => 'Tempi medi per ciascuna lavorazione:',
                'tabella4' => '',
                'h2g' => 'Lavorazioni più richieste:',
                'tabella5' => '',
                'azzera' => 'href="officina"'
            ],
            'template' => 'tpl/officina.html',
        ],
    ];

    
    #pagina default
    if (!isset($_REQUEST['p']) || !isset($pagine[$_REQUEST['p']])) {
        
        $_REQUEST['p'] = 'homepage';
    }
    
    # abbreviazione
    $p = $pagine[$_REQUEST['p']];