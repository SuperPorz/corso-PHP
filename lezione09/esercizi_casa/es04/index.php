<?php

    // DEBUG
    ini_set('display_errors', true);


    // LIBRERIE E MODULI PERENNI
    require 'lib/render.php';
    include 'inc/pagine.php';


    // IMPOSTAZIONE PAGINA DEFAULT
    if (!isset($_REQUEST['p']) || !isset($pagine[$_REQUEST['p']])) {
        $_REQUEST['p'] = 'classifiche';
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

        /* case (!isset($_REQUEST['p']) || !isset($pagine[$_REQUEST['p']]) || $_REQUEST['p'] == 'classifiche' || $_REQUEST['p'] == 'index'):  // RENDER CLASSIFICHE
            $_REQUEST['p'] = 'classifiche';  
            $render = Render\render($p['template'],$p['contenuto']); # render parti principali
            echo $render;
            break; */

        case($_REQUEST['p'] == 'lista-piloti'):  // RENDER PILOTI
            $render = Render\render($p['template'],$p['contenuto']); # render parti principali
            $render = str_replace('{{select}}', $p['contenuto']['select'], $render);  # render parti specifiche della pagina
            $render = str_replace('{{fields}}', $p['contenuto']['fields'], $render);  # render parti specifiche della pagina
            $render = str_replace('="required"', 'required', $render);  # render parti specifiche della pagina
            echo $render;
            break;
            
        case($_REQUEST['p'] == 'lista-teams'):  // RENDER TEAMS 
            $render = Render\render($p['template'],$p['contenuto']); # render parti principali
            $render = str_replace('{{select}}', $p['contenuto']['select'], $render);  # render parti specifiche della pagina
            $render = str_replace('{{fields}}', $p['contenuto']['fields'], $render);  # render parti specifiche della pagina
            $render = str_replace('="required"', 'required', $render);  # render parti specifiche della pagina
            echo $render;
            break;
                
        default:                               
            $render = Render\render($p['template'],$p['contenuto']); # render parti principali
            $render = str_replace('<p><a href="classifiche.html">TORNA ALLE CLASSIFICHE</a></p>', '', $render); # render parti specifiche
            echo $render;
            break;
    }