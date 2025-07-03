<?php

    #se '$_REQUEST['azione']' non è settato, lo imposto su 'aggiungi'
    if (!isset($_REQUEST['azione']) || empty($_REQUEST['azione'])) {
        $_REQUEST['azione'] = 'aggiungi';
    }

    # LOGICA DI AGGIUNTA DATI AL DB
    switch ( $_REQUEST['azione'] ){

        case 'aggiungi':
            if (isset($_REQUEST['nome']) && !empty($_REQUEST['nome']) 
                && isset($_REQUEST['cognome']) && !empty($_REQUEST['cognome'])
                && isset($_REQUEST['numero']) && !empty($_REQUEST['numero'])
                && (!isset($_REQUEST['id_p']) || empty($_REQUEST['id_p']))
            )
                {
                    $risultato = Umani\aggiungi($_REQUEST['nome'], $_REQUEST['cognome'], $_REQUEST['numero']);
                    if ($risultato) {
                        // Svuota i campi dopo l'inserimento riuscito
                        unset($_REQUEST['nome']);
                        unset($_REQUEST['cognome']);
                        unset($_REQUEST['numero']);

                        // Reindirizza per evitare reinvio del form
                        header('Location: modifica_umani.html');
                        exit;
                    }
                }
            break;

        case 'modifica':
            if (isset($_REQUEST['nome']) && !empty($_REQUEST['nome']) 
                && isset($_REQUEST['cognome']) && !empty($_REQUEST['cognome'])
                && isset($_REQUEST['numero']) && !empty($_REQUEST['numero'])
                && isset($_REQUEST['id_p']) && !empty($_REQUEST['id_p'])
                )
                {
                    $risultato = Umani\modifica($_REQUEST['id_p'], $_REQUEST['nome'], $_REQUEST['cognome'], $_REQUEST['numero']);
                    if ($risultato) {

                        // Reindirizza dopo la modifica
                        header('Location: modifica_umani.html');
                        exit;
                    }
                }

            if (isset($_REQUEST['id_p']) && !empty($_REQUEST['id_p'])) // questo if serve per popolare i campi input in caso si chieda la modifica
                {
                    $dettagli_persona = Umani\dettagli($_REQUEST['id_p']);
                    if (!empty($dettagli_persona)) 
                        {
                            $_REQUEST['nome'] = $dettagli_persona['nome'];
                            $_REQUEST['cognome'] = $dettagli_persona['cognome'];
                            $_REQUEST['numero'] = $dettagli_persona['numero'];
                        }
                }
            break;

        case 'elimina':
            if (isset($_REQUEST['id_p'])) 
                {  
                    $risultato = Umani\elimina($_REQUEST['id_p']);
                    if ($risultato) {
                        
                        // Reindirizza dopo l'eliminazione
                        header('Location: modifica_umani.html');
                        exit;
                    }
                }
            break;
    }