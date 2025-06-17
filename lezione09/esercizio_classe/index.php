<?php

    require_once 'lib/render.php';
    require_once 'lib/html.php';
    require_once 'lib/elenco.php';
    require_once 'inc/pagine.php';

    if( isset($p['include']) ) {
        require_once $p['include'];
        require_once $p['include2'];
    }

    echo Render\render(
        $p['template'],
        $p['contenuto']
    );