<?php

    # SETTO IL CAMPO HIDDEN 'AZIONE' SUL VALORE AGGIUNGI
    if (!isset($_REQUEST['azione']) || empty($_REQUEST['azione'])) {
        $_REQUEST['azione'] = 'aggiungi';
    }

    # LOGICA DI AGGIUNTA DATI AL DB
    switch ($_REQUEST['azione']) {

        case 'aggiungi':
            if (isset($_REQUEST['nome_p']) && isset($_REQUEST['telefono']) && (isset($_REQUEST['id_p']) || !empty($_REQUEST['id_p']))) 
                {  
                    Padroni\aggiungi($_REQUEST['nome_p'], $_REQUEST['telefono']);
                    unset($_REQUEST['id_p']);
                    unset($_REQUEST['nome_p']);
                    unset($_REQUEST['telefono']);
                }
            break;

        case 'modifica':
            if (isset($_REQUEST['nome_p']) && isset($_REQUEST['telefono']) && isset($_REQUEST['id_p']) && !empty($_REQUEST['id_p']))
                {
                    Padroni\modifica($_REQUEST['id_p'], $_REQUEST['nome_p'], $_REQUEST['telefono']);
                    unset($_REQUEST['id_p']);
                    unset($_REQUEST['nome_p']);
                    unset($_REQUEST['telefono']);                    
                }

            if (isset($_REQUEST['id_p']) && !empty($_REQUEST['id_p'])) // questo if serve per popolare i campi input in caso si chieda la modifica
                {
                    $dettagli_padrone = Padroni\dettaglio_padrone($_REQUEST['id_p']);
                    if (!empty($dettagli_padrone)) 
                        {
                            $_REQUEST['nome_p'] = $dettagli_padrone['nome_p'];
                            $_REQUEST['telefono'] = $dettagli_padrone['telefono'];
                        }
                }
            break;

        case 'elimina':
            if (isset($_REQUEST['id_p'])) 
            
                {
                    Padroni\elimina($_REQUEST['id_p']);
                    unset($_REQUEST['id_p']);
                }
            break;
    }