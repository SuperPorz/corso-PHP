<?php

    # SETTO IL CAMPO HIDDEN 'AZIONE' SUL VALORE AGGIUNGI
    if (!isset($_REQUEST['azione']) || empty($_REQUEST['azione'])) {
        $_REQUEST['azione'] = 'aggiungi';
    }


    # LOGICA DI AGGIUNTA PIATTO AL DB
    switch ($_REQUEST['azione']) {

        case 'aggiungi':
            if(isset($_REQUEST['nome_p']) && (isset($_REQUEST['idi']) || !empty($_REQUEST['idi']))) 
                {
                    var_dump($_REQUEST);
                    foreach($_REQUEST['idi'] as $valore) {

                        Piatti\aggiungi($_REQUEST['nome_p'], $v);
                        unset($_REQUEST['nome_p']);                    
                        unset($_REQUEST['idi']);
                    }
                }
            break;

        case 'modifica':
            if(isset($_REQUEST['nome_p']) && (isset($_REQUEST['idi']) && !empty($_REQUEST['idi'])) && (isset($_REQUEST['idi']) && !empty($_REQUEST['idi']))) 
                {
                    /* $ingredienti_scelti =[];
                    foreach($_REQUEST['idi'] as $k => $v) {
                        $ingredienti_scelti[] = $v;
                    } */

                    Piatti\modifica($_REQUEST['idp'], $_REQUEST['nome_p'], $_REQUEST['idi']);
                    unset($_REQUEST['idp']);
                    unset($_REQUEST['nome_p']);
                    unset($_REQUEST['idi']);                    
                }

            if (isset($_REQUEST['idi']) && !empty($_REQUEST['idi'])) // questo if serve per popolare i campi input in caso si chieda la modifica
                {
                    $dettagli_ingrediente = Piatti\dettagli($_REQUEST['idp']);
                    if (!empty($dettagli_ingrediente)) 
                        {
                            $_REQUEST['idp'] = $dettagli_ingrediente['idp'];
                            $_REQUEST['nome_p'] = $dettagli_ingrediente['nome_p'];
                            $_REQUEST['idi'] = $dettagli_ingrediente['idi'];
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





/*     $azienda = array (

        'capo_01' => array (
            0 => 'dipendente_01',
            1 => 'dipendente_01',
            2 => 'dipendente_01'
        ),

        'capo_02' => array (
            0 => 'dipendente_03',
            1 => 'dipendente_04',
            2 => 'dipendente_05'
        )
        );

        $azienda = array (

            'dipendente_01' => 'capo01',
            'dipendente_02' => 'capo01',
            'dipendente_03' => 'capo01',
            'dipendente_04' => 'capo07',
            'dipendente_05' => 'capo07',        
        ); */