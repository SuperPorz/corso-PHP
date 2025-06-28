<?php

    // DEBUG
    ini_set('display_errors', true);

    // librerie e moduli PERENNI
    require 'lib/render.php';
    require 'mod/team.mod.php';
    
    // LIBRERIE E MODULI SPECIFICI
    if (!isset($_REQUEST['p'])) 
    {
        $_REQUEST['p'] = 'lista_piloti';
    } 
    
    if ($_REQUEST['p'] == 'lista_piloti' || $_REQUEST['p'] == 'index') {
        require 'mod/piloti.mod.php';
        require 'mod/piloti.ctrl.php';
        require 'mod/piloti.view.php';
    }
    elseif ($_REQUEST['p'] == 'lista_team') {
        require 'mod/team.ctrl.php';
        require 'mod/team.view.php';
    }