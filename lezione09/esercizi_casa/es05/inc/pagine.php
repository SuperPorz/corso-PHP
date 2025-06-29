<?php

    $pagine = array(
        'homepage' => array(
            'contenuto' => array(
                'titolo' => 'homepage',
                'h1' => 'CENTRO SPORTIVO LORENZONI spa',
                'h2' => 'Benvenuti!',
                'table' => '',
                'FORM' => '',
                'select' => '',
                'fields' => '',
            ),
            'template' => 'tpl/main.html',
            'include' => [
                'mod/campi.mod.php',
                'mod/utenti.mod.php',
                'mod/prenotazioni.mod.php',
            ],
        ),
        'gestione-campi' => array(
            'contenuto' => array(
                'titolo' => 'campi',
                'h1' => 'MODIFICA E INSERIMENTO CAMPI DA TENNIS',
                'h2' => 'Inserisci o modifica i campi da tennis:',
                'table' => '',
                'FORM' => '',
                'select' => '',
                'fields' => '',
            ),
            'template' => 'tpl/main.html',
            'include' => [
                'mod/campi.mod.php',
                'mod/campi.ctrl.php',
                'mod/campi.view.php',
            ],
        ),
        'registrazione-utenti' => array(
            'contenuto' => array(
                'titolo' => 'utenti',
                'h1' => 'REGISTRAZIONE UTENTI',
                'h2' => 'Inserisci i tuoi dati per poter prenotare i campi da tennis:',
                'table' => '',
                'FORM' => '',
                'select' => '',
                'fields' => '',
            ),
            'template' => 'tpl/main.html',
            'include' => [
                'mod/utenti.mod.php',
                'mod/utenti.ctrl.php',
                'mod/utenti.view.php',
            ],
        ),
        'prenotazioni' => array(
            'contenuto' => array(
                'titolo' => 'prenotazioni',
                'h1' => 'PRENOTAZIONE CAMPI PER UTENTI REGISTRATI',
                'h2' => 'Seleziona campo, data, fascia oraria e utenti per inviare la prenotazione:',
                'table' => '',
                'FORM' => '',
                'select_campi' => '',
                'select_fasce' => '',
                'select_utente1' => '',
                'select_utente2' => '',
                'fields' => '',
            ),
            'template' => 'tpl/main.html',
            'include' => [
                'mod/utenti.mod.php',
                'mod/campi.mod.php',
                'mod/prenotazioni.mod.php',
                'mod/prenotazioni.ctrl.php',
                'mod/prenotazioni.view.php',
            ],
        ),
    );