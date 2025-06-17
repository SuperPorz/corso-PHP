<?php

    # gestione delle modifiche all'elenco CANI

    if (isset($_REQUEST['nome']) && isset($_REQUEST['anno_nascita']) && isset($_REQUEST['id'])) {
        if ($_REQUEST['nome'] != '' && $_REQUEST['anno_nascita'] != '') {
            $p['contenuto']['testo'] = 'modifico ' . $_REQUEST['nome'] . ' che risulta di taglia ' . $_REQUEST['anno_nascita'];
            $r = Elenco\modifica($_REQUEST['id'], $_REQUEST['nome'], $_REQUEST['anno_nascita']);
            if ($r) {
                $p['contenuto']['testo'] .= ' - modifica riuscita';
            } else {
                $p['contenuto']['testo'] .= ' - modifica fallita';
            }
        }
    } elseif (isset($_REQUEST['nome']) && isset($_REQUEST['anno_nascita'])) {
        if ($_REQUEST['nome'] != '' && $_REQUEST['anno_nascita'] != '') {
            $p['contenuto']['testo'] = 'aggiungo ' . $_REQUEST['nome'] . ' nato nel ' . $_REQUEST['anno_nascita'];
            $r = Elenco\aggiungi($_REQUEST['nome'], $_REQUEST['anno_nascita']);
            if ($r) {
                $p['contenuto']['testo'] .= ' - aggiunta riuscita';
            } else {
                $p['contenuto']['testo'] .= ' - aggiunta fallita';
            }
        }
    } elseif (isset($_REQUEST['elimina'])) {
        if( ! empty($_REQUEST['elimina']) ) {
            $r = Elenco\elimina($_REQUEST['elimina']);
            $p['contenuto']['testo'] = 'eliminazione di ' . $_REQUEST['elimina'] . ' in corso...';
            if ($r) {
                $p['contenuto']['testo'] .= ' eliminazione riuscita';
            } else {
                $p['contenuto']['testo'] .= ' eliminazione fallita';
            }
        }
    }
