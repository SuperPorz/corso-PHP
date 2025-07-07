<?php

    // DEBUG
    ini_set('display_errors', true);


    // LIBRERIE E MODULI PERENNI
    require 'lib/render.php';
    include 'inc/pagine.php';


    // IMPOSTAZIONE PAGINA DEFAULT
    if (!isset($_REQUEST['p']) || !isset($pagine[$_REQUEST['p']])) {
        $_REQUEST['p'] = 'homepage';
    }
    $p = $pagine[$_REQUEST['p']]; # scorciatoia per la pagina richiesta 


    // LIBRERIE E MODULI SPECIFICI
    if( isset($p['include']) ) {
        foreach ($p['include'] as $include) {
            require_once $include;
        }
    }


    // RENDERING DELLE PAGINE (logica)
    switch (True) {
            
        case($_REQUEST['p'] == 'gestione-campi'):  // RENDER TEAMS 
            $render = Render\render($p['template'],$p['contenuto']); # render parti principali
            $render = str_replace('="required"', 'required', $render);  # render parti specifiche della pagina
            echo $render;
            break;

        case($_REQUEST['p'] == 'registrazione-utenti'):  // RENDER TEAMS 
            $render = Render\render($p['template'],$p['contenuto']); # render parti principali
            $render = str_replace('="required"', 'required', $render);  # render parti specifiche della pagina
            echo $render;
            break;
        
        case($_REQUEST['p'] == 'prenotazioni'):  // RENDER TEAMS 
            $render = Render\render($p['template'],$p['contenuto']); # render parti principali
            $render = str_replace('{{select_campi}}', $p['contenuto']['select_campi'], $render);  # render parti specifiche della pagina
            $render = str_replace('{{select_fasce}}', $p['contenuto']['select_fasce'], $render);  # render parti specifiche della pagina
            $render = str_replace('{{select_utente1}}', $p['contenuto']['select_utente1'], $render);  # render parti specifiche della pagina
            $render = str_replace('{{select_utente2}}', $p['contenuto']['select_utente2'], $render);  # render parti specifiche della pagina
            $render = str_replace('="required"', 'required', $render);  # render parti specifiche della pagina
            echo $render;
            break;
                
        default:                               
            $render = Render\render($p['template'],$p['contenuto']); # render parti principali
            $render = str_replace('<p><a href="homepage.html">TORNA ALLA HOMEPAGE</a></p>', '', $render); # render parti specifiche
            echo $render;
            break;
    }