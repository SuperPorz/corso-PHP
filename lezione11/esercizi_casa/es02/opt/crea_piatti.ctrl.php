<?php

    # SETTO IL CAMPO HIDDEN 'AZIONE' SUL VALORE AGGIUNGI
    if (!isset($_REQUEST['azione']) || empty($_REQUEST['azione'])) {
        $_REQUEST['azione'] = 'aggiungi';
    }


    # LOGICA DI AGGIUNTA PIATTO AL DB
    switch ($_REQUEST['azione']) {

        case 'aggiungi':
            if(isset($_REQUEST['idp']) && !empty($_REQUEST['idp']))
                {
                    $array_ingredienti = [];
                    foreach($_REQUEST as $k => $v) {
                        if (is_numeric($k)) {
                            $array_ingredienti[] = $v;
                        }
                    }

                    Crea_piatti\aggiungi($_REQUEST['idp'], $array_ingredienti);
                    unset($_REQUEST);   // faccio l'unset di tutto
                    $_REQUEST['azione'] = 'aggiungi';
                }
            break;

        case 'modifica':
            if(isset($_REQUEST['idp']) && !empty($_REQUEST['idp']))
                {
                    $array_ingredienti = [];
                    foreach($_REQUEST as $k => $v) {
                        if (is_numeric($k)) {
                            $array_ingredienti[] = $v;
                        }
                    }

                    Crea_piatti\modifica($_REQUEST['idp'],$array_ingredienti);
                    unset($_REQUEST);   // faccio l'unset di tutto
                    $_REQUEST['azione'] = 'aggiungi';
                }

            if (isset($_REQUEST['idp']) && !empty($_REQUEST['idp'])) // questo if serve per popolare i campi input in caso si chieda la modifica
                {
                    $dettagli_piatto = Crea_piatti\dettagli($_REQUEST['idp']);
                    if (!empty($dettagli_piatto)) 
                        {
                            $_REQUEST['idp'] = $dettagli_piatto['idp'];
                            $_REQUEST['ingredienti'] = $dettagli_piatto['ingredienti'];
                        }
                }
            break;

        case 'elimina':
            if (isset($_REQUEST['idp']))
                {
                    Crea_piatti\elimina($_REQUEST['idp']);
                    unset($_REQUEST['idp']);
                }
            break;
    }