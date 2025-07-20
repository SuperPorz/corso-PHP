<?php

    # SETTO IL CAMPO HIDDEN 'AZIONE' SUL VALORE AGGIUNGI
    if (!isset($_REQUEST['azione']) || empty($_REQUEST['azione'])) {
        $_REQUEST['azione'] = 'aggiungi';
    }


    # LOGICA DI AGGIUNTA INGREDIENTE AL DB
    switch ($_REQUEST['azione']) {

        case 'aggiungi':
            if(isset($_REQUEST['nome_i']) && (isset($_REQUEST['idi']) || !empty($_REQUEST['idi']))) 
                {
                    Ingredienti\aggiungi($_REQUEST['nome_i']);
                    unset($_REQUEST['idi']);
                    unset($_REQUEST['nome_i']);                    
                }
            break;

        case 'modifica':
            if(isset($_REQUEST['nome_i']) && (isset($_REQUEST['idi']) && !empty($_REQUEST['idi']))) 
                {
                    Ingredienti\modifica($_REQUEST['idi'], $_REQUEST['nome_i']);
                    unset($_REQUEST['idi']);
                    unset($_REQUEST['nome_i']);                    
                }

            if (isset($_REQUEST['idi']) && !empty($_REQUEST['idi'])) // questo if serve per popolare i campi input in caso si chieda la modifica
                {
                    $dettagli_ingrediente = Ingredienti\dettagli($_REQUEST['idi']);
                    if (!empty($dettagli_ingrediente)) 
                        {
                            $_REQUEST['nome_i'] = $dettagli_ingrediente['nome_i'];
                        }
                }
            break;

        case 'elimina':
            if (isset($_REQUEST['idi'])) 
            
                {
                    Ingredienti\elimina($_REQUEST['idi']);
                    unset($_REQUEST['idi']);
                }
            break;
    }