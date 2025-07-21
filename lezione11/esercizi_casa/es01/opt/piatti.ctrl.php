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
                    $array_ingredienti = [];
                    foreach($_REQUEST as $k => $v) {
                        if (is_numeric($k)) {
                            $array_ingredienti[] = $v;
                        }
                    }

                    Piatti\aggiungi($_REQUEST['nome_p'], $array_ingredienti);
                    unset($_REQUEST);   // faccio l'unset di tutto
                    $_REQUEST['azione'] = 'aggiungi';
                }
            break;

        case 'modifica':
            if(isset($_REQUEST['nome_p']) && !empty($_REQUEST['nome_p']) && (isset($_REQUEST['idp']) && !empty($_REQUEST['idp']))) 
                {
                    $array_ingredienti = [];
                    foreach($_REQUEST as $k => $v) {
                        if (is_numeric($k)) {
                            $array_ingredienti[] = $v;
                        }
                    }

                    Piatti\modifica($_REQUEST['idp'], $_REQUEST['nome_p'], $array_ingredienti);
                    unset($_REQUEST);   // faccio l'unset di tutto
                    $_REQUEST['azione'] = 'aggiungi';
                }

            if (isset($_REQUEST['idp']) && !empty($_REQUEST['idp'])) // questo if serve per popolare i campi input in caso si chieda la modifica
                {
                    $dettagli_piatto = Piatti\dettagli($_REQUEST['idp']);
                    if (!empty($dettagli_piatto)) 
                        {
                            $_REQUEST['idp'] = $dettagli_piatto['idp'];
                            $_REQUEST['nome_p'] = $dettagli_piatto['nome_p'];
                            $_REQUEST['ingredienti'] = $dettagli_piatto['ingredienti'];
                        }
                }
            break;

        case 'elimina':
            if (isset($_REQUEST['idp'])) 
            
                {
                    Piatti\elimina($_REQUEST['idp']);
                    unset($_REQUEST['idp']);
                }
            break;
    }