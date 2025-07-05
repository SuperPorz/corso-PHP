<?php

    # librerie di FUNZIONI di base
    foreach (glob('lib/*.php') as $file) {
        require_once $file;
    }

    # files di LOGICA da includere a prescindere
    foreach(glob('inc/*.php') as $file) {
        require_once $file;
    }

    # inclusioni specifiche per pagina
    foreach($p['include'] as $k => $percorso_file) {
        require_once $percorso_file;
    }

    # RENDER FINALE DELLA PAGINA
    foreach($p['contenuto'] as $k) {
        $render = Funzioni\render($p['template'], $p['contenuto']);
    }
    echo $render;