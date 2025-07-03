<?php

    #se '$_REQUEST['azione']' non è settato, lo imposto su 'aggiungi'
    if (!isset($_REQUEST['azione']) && empty($_REQUEST['azione'])) {
        $_REQUEST['azione'] = 'aggiungi';
    }

    # LOGICA DI AGGIUNTA DATI AL DB
    switch ( $_REQUEST['azione'] ){

        case 'aggiungi':
            if (isset($_REQUEST['nome']) && !empty($_REQUEST['nome']) 
                && isset($_REQUEST['cognome']) && !empty($_REQUEST['cognome'])
                && isset($_REQUEST['numero']) && !empty($_REQUEST['numero'])
                && isset($_REQUEST['id_p']) && empty($_REQUEST['id_p'])
            )
                {
                    \Umani\aggiungi($_REQUEST['nome'], $_REQUEST['cognome'], $_REQUEST['numero']);
                }
            break;

        case 'modifica':
            if (isset($_REQUEST['nome']) && !empty($_REQUEST['nome']) 
                && isset($_REQUEST['cognome']) && !empty($_REQUEST['cognome'])
                && isset($_REQUEST['numero']) && !empty($_REQUEST['numero'])
                && isset($_REQUEST['id_p']) && !empty($_REQUEST['id_p'])
            )
                {
                    Umani\modifica($_REQUEST['id_p'], $_REQUEST['nome'], $_REQUEST['cognome'], $_REQUEST['numero']);
                }
            if (isset($_REQUEST['id_p'])) // questo if serve per popolare i campi input in caso si chieda la modifica
                {
                    $dettagli_persona = Umani\dettagli($_REQUEST['id_p']);
                    $_REQUEST['nome'] = $dettagli_persona['nome'];
                    $_REQUEST['cognome'] = $dettagli_persona['cognome'];
                    $_REQUEST['numero'] = $dettagli_persona['numero'];
                }
            break;

        case 'elimina':
            if (isset($_REQUEST['id_p'])) 
                {  
                    Umani\elimina($_REQUEST['id_p']);
                }
            break;
    }