<?php

    # INCLUSIONI GLOBALI
    foreach(glob('lib/*.php') as $file) {
        require_once $file; 
    }

    foreach(glob('inc/*.php') as $file) {
        require_once $file; 
    }

    # INCLUSIONI SPECIFICHE
    foreach( $p['include'] as $file ) {
        require_once $file;
    }

    # RENDER FINALE
    foreach($p['contenuto'] as $k) {
        $render = Funzioni\render($p['template'], $p['contenuto']);
    }
    echo $render;