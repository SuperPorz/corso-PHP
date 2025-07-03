<?php

    // debug
    echo "DEBUG - Azione: " . ($_REQUEST['azione'] ?? 'non settato') . "<br>";
    echo "DEBUG - Nome: " . ($_REQUEST['nome'] ?? 'non settato') . "<br>";
    echo "DEBUG - Cognome: " . ($_REQUEST['cognome'] ?? 'non settato') . "<br>";
    echo "DEBUG - Numero: " . ($_REQUEST['numero'] ?? 'non settato') . "<br>";
    echo "DEBUG - ID_P: " . ($_REQUEST['id_p'] ?? 'non settato') . "<br>";

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
                    \Umani\aggiungi($_REQUEST['nome'], $_REQUEST['cognome'], $_REQUEST['numero']);
                }
            break;

        case 'modifica':
            if (isset($_REQUEST['id_p'])) // questo if serve per popolare i campi input in caso si chieda la modifica
                {
                    $dettagli_persona = Umani\dettagli($_REQUEST['id_p']);
                    if (!empty($dettagli_persona)) 
                        {
                            $_REQUEST['nome'] = $dettagli_persona['nome'];
                            $_REQUEST['cognome'] = $dettagli_persona['cognome'];
                            $_REQUEST['numero'] = $dettagli_persona['numero'];
                        }
                }

            if (isset($_REQUEST['nome']) && !empty($_REQUEST['nome']) 
                && isset($_REQUEST['cognome']) && !empty($_REQUEST['cognome'])
                && isset($_REQUEST['numero']) && !empty($_REQUEST['numero'])
                && isset($_REQUEST['id_p']) && !empty($_REQUEST['id_p'])
                )
                {
                    Umani\modifica($_REQUEST['id_p'], $_REQUEST['nome'], $_REQUEST['cognome'], $_REQUEST['numero']);
                }
            break;

        case 'elimina':
            if (isset($_REQUEST['id_p'])) 
                {  
                    Umani\elimina($_REQUEST['id_p']);
                }
            break;
    }