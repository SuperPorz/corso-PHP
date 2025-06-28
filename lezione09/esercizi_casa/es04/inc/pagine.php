<?php

    /* # PAGINA DI DEFAULT
    if (!isset($_REQUEST['p']) || !isset($pagine[$_REQUEST['p']])) {
        $_REQUEST['p'] = 'classifiche';
    } */

    $pagine = array(
        'classifiche' => array(
            'contenuto' => array(
                'titolo' => 'Classifiche',
                'h1' => 'CLASSIFICHE FUTURA spa RACING 2025',
                'h2_1' => 'Classifica Piloti:',
                'h2_2' => 'Classifica Teams:',
                'table1' => '',
                'table2' => '',
                'INSERIMENTO_DATI' => '',
                'select' => '',
                'fields' => '',
            ),
            'template' => 'tpl/main.html',
            'include' => [
                'mod/piloti.mod.php',
                'mod/team.mod.php',
                'mod/classifiche.mod.php',
                'mod/classifiche.view.php',
            ],
        ),
        'lista-piloti' => array(
            'contenuto' => array(
                'titolo' => 'lista piloti',
                'h1' => 'Elenco Piloti',
                'h2_1' => '',
                'h2_2' => '',
                'table1' => '',
                'table2' => '',
                'INSERIMENTO_DATI' => '',
                'select' => '',
                'fields' => '',
            ),
            'template' => 'tpl/main.html',
            'include' => [
                'mod/team.mod.php',
                'mod/piloti.mod.php',
                'mod/piloti.ctrl.php',
                'mod/piloti.view.php',
            ],
        ),
        'lista-teams' => array(
            'contenuto' => array(
                'titolo' => 'lista teams',
                'h1' => 'Elenco Teams',
                'h2_1' => '',
                'h2_2' => '',
                'table1' => '',
                'table2' => '',
                'INSERIMENTO_DATI' => '',
                'select' => '',
                'fields' => '',
            ),
            'template' => 'tpl/main.html',
            'include' => [
                'mod/team.mod.php',
                'mod/team.ctrl.php',
                'mod/team.view.php',
            ],
        ),
    );
    
    #$p = $pagine[$_REQUEST['p']]; # scorciatoia per la pagina richiesta 