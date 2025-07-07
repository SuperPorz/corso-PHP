<?php

    # SETTO IL CAMPO HIDDEN 'AZIONE' SUL VALORE AGGIUNGI
    if (!isset($_REQUEST['azione']) || empty($_REQUEST['azione'])) {
        $_REQUEST['azione'] = 'aggiungi';
    }

    # LOGICA DI AGGIUNTA DATI AL DB
    switch ($_REQUEST['azione']) {

        case 'aggiungi':
            if(isset($_REQUEST['nome']) && isset($_REQUEST['data_n']) && isset($_REQUEST['data_v']) && isset($_REQUEST['id_p']) 
                && (isset($_REQUEST['id_c']) || !empty($_REQUEST['id_c']))) 
                {
                    // qui verifico che la data vaccino non sia prima della nascita cane e che il cane non sia nato NEL FUTURO
                    if ((date($_REQUEST['data_v']) < date($_REQUEST['data_n'])) || (date($_REQUEST['data_n']) > date("Y-m-d"))) {
                        echo 'ERRORE! Date inserite non valide!';
                    } else {
                        Cani\aggiungi($_REQUEST['nome'], $_REQUEST['data_n'], $_REQUEST['data_v'], $_REQUEST['id_p']);
                        //$p['contenuto']['form'] = Cani\clean_input($_REQUEST['azione']);
                        unset($_REQUEST['id_c']);
                        unset($_REQUEST['nome']);
                        unset($_REQUEST['data_n']);
                        unset($_REQUEST['data_v']);
                        unset($_REQUEST['id_p']);
                    }
                }
            break;

        case 'modifica':
            if(isset($_REQUEST['nome']) && isset($_REQUEST['data_n']) && isset($_REQUEST['data_v'])  && isset($_REQUEST['id_p']) 
                && (isset($_REQUEST['id_c']) && !empty($_REQUEST['id_c']))) 
                {
                    // qui verifico che la data vaccino non sia prima della nascita cane e che il cane non sia nato NEL FUTURO
                    if ((date($_REQUEST['data_v']) < date($_REQUEST['data_n'])) || (date($_REQUEST['data_n']) > date("Y-m-d"))) {
                        echo 'ERRORE! Date inserite non valide!';
                    } else {
                        Cani\modifica($_REQUEST['id_c'], $_REQUEST['nome'], $_REQUEST['data_n'], $_REQUEST['data_v'],  $_REQUEST['id_p'] );
                        //$p['contenuto']['form'] = Cani\clean_input($_REQUEST['azione']);
                        unset($_REQUEST['id_c']);
                        unset($_REQUEST['nome']);
                        unset($_REQUEST['data_n']);
                        unset($_REQUEST['data_v']);
                        unset($_REQUEST['id_p']);
                    }
                }

            if (isset($_REQUEST['id_c']) && !empty($_REQUEST['id_c'])) // questo if serve per popolare i campi input in caso si chieda la modifica
                {
                    $dettagli_cane = Cani\dettagli($_REQUEST['id_c']);
                    if (!empty($dettagli_cane)) 
                        {
                            $_REQUEST['nome'] = $dettagli_cane['nome'];
                            $_REQUEST['data_n'] = $dettagli_cane['data_n'];
                            $_REQUEST['data_v'] = $dettagli_cane['data_v'];
                        }
                }
            break;

        case 'elimina':
            if (isset($_REQUEST['id_c'])) 
            
                {
                    Cani\elimina($_REQUEST['id_c']);
                    //$p['contenuto']['form'] = Cani\clean_input($_REQUEST['azione']);
                    unset($_REQUEST['id_c']);
                }
            break;
    }