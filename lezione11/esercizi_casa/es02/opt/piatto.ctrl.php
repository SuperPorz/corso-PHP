<?php

    # SETTO IL CAMPO HIDDEN 'AZIONE' SUL VALORE AGGIUNGI
    if (!isset($_REQUEST['azione']) || empty($_REQUEST['azione'])) {
        $_REQUEST['azione'] = 'aggiungi';
    }


    # LOGICA DI AGGIUNTA PIATTO AL DB
    switch ($_REQUEST['azione']) {

        case 'aggiungi':
            if(isset($_REQUEST['nome_p']) && !empty($_REQUEST['nome_p']))
                {
                    Piatto\aggiungi($_REQUEST['nome_p']);
                    unset($_REQUEST);   // faccio l'unset di tutto
                    $_REQUEST['azione'] = 'aggiungi';
                }
            break;

        case 'modifica':
            if(isset($_REQUEST['nome_p']) && !empty($_REQUEST['nome_p']) && (isset($_REQUEST['idp']) && !empty($_REQUEST['idp']))) 
                {
                    Piatto\modifica($_REQUEST['idp'], $_REQUEST['nome_p']);
                    unset($_REQUEST);   // faccio l'unset di tutto
                    $_REQUEST['azione'] = 'aggiungi';
                }

            if (isset($_REQUEST['idp']) && !empty($_REQUEST['idp'])) // questo if serve per popolare i campi input in caso si chieda la modifica
                {
                    $dettagli_piatto = Piatto\dettagli($_REQUEST['idp']);
                    if (!empty($dettagli_piatto)) 
                        {
                            $_REQUEST['idp'] = $dettagli_piatto['idp'];
                            $_REQUEST['nome_p'] = $dettagli_piatto['nome_p'];
                        }
                }
            break;

        case 'elimina':
            if (isset($_REQUEST['idp'])) 
                {
                    Piatto\elimina($_REQUEST['idp']);
                    unset($_REQUEST['idp']);
                }
            break;
    }