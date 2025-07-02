<?php

    #se REQUEST_azione non è settato, per ora lo imposto su 'aggiungi'
    if (!isset($_REQUEST['azione']) && empty($_REQUEST['azione'])) {
        $_REQUEST['azione'] = 'aggiungi';
    }

    switch( $_REQUEST['azione'] ) {
        case 'aggiungi':
            if (isset($_REQUEST['nome']) && isset($_REQUEST['numero'])) {
                $r = Persone\aggiungi($_REQUEST['nome'], $_REQUEST['numero']);
                if($r) {
                    $p['contenuto']['footer'] = "<p>aggiunta di ".$_REQUEST['nome']." con numero ".$_REQUEST['numero']."</p>";
                } else {
                    $p['contenuto']['footer'] = "<p>errore nell'aggiunta di ".$_REQUEST['nome']." con numero ".$_REQUEST['numero']."</p>";
                }
            }
            break;

        case 'modifica':
            if (isset($_REQUEST['id_p']) && isset($_REQUEST['nome']) && isset($_REQUEST['numero'])) {
                $r = Persone\modifica($_REQUEST['id_p'], $_REQUEST['nome'], $_REQUEST['numero']);
                if($r) {
                    $p['contenuto']['footer'] = "<p>modifica di id ".$_REQUEST['id_p']." riuscita</p>";
                } else {
                    $p['contenuto']['footer'] = "<p>errore nella modifica di id ".$_REQUEST['id_p']."</p>";
                }
            }
            if( isset($_REQUEST['id_p']) ) {
                $persona = Persone\dettagli($_REQUEST['id_p']);
                if(!empty($persona)) {
                    $_REQUEST['id_p'] = $persona['id_p'];
                    $_REQUEST['nome'] = $persona['nome'];
                    $_REQUEST['numero'] = $persona['numero'];
                } else {
                    $p['contenuto']['footer'] = "<p>errore nel recupero della persona con id ".$_REQUEST['id_p']."</p>";
                }
            }
            break;

        case 'elimina':
            if (isset($_REQUEST['id_p'])) {
                $r = Persone\elimina($_REQUEST['id_p']);
                if($r) {
                    $p['contenuto']['footer'] = "<p>eliminazione di id ".$_REQUEST['id_p']." riuscita</p>";
                } else {
                    $p['contenuto']['footer'] = "<p>errore nell'eliminazione di id ".$_REQUEST['id_p']."</p>";
                }
            }
            break;
    }
