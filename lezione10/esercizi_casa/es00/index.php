<?php

    /* $_REQUEST = [
        'p' => 'modifica_umani',
        'azione' => 'modifica',
        'id_p' => 'dec705',
        'nome' => 'michele',
        'cognome' => 'lorenzoni',
        'numero' => '999',
    ]; */

    #librerie di base (funzioni)
    foreach ((glob('lib/*.php')) as $files) {
        require_once $files;
    }

    #files aventi scopi di base da includere a prescindere (files di logica)
    foreach((glob('inc/*.php')) as $files) {
        require_once $files;
    }

    #inclusioni specifiche per pagina
    foreach($p['include'] as $k => $percorso_file) {
        require_once $percorso_file;
    }

    #render della pagina
    foreach ($p['contenuto'] as $k => $v) {
        $render = Funzioni\render($p['template'], $p['contenuto']);
    }
    echo $render;    