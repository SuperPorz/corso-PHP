<?php

    # INCLUDE
    include_once 'inc/DatabaseConnection.php';
    include_once 'classes/database.php';
    include_once 'classes/officina.php';


    # ISTANZE




    # RENDER FINALE
    $render = file_get_contents('tpl/main.html');
    $render = str_replace('{{options}}', $opzioni, $render);
    echo $render;