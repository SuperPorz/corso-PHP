<?php

    switch ($_REQUEST['azione']) {

        case 'aggiungi':
            if(isset($_REQUEST['nome']) && isset($_REQUEST['data_n']) && isset($_REQUEST['data_v']) 
                && (isset($_REQUEST['id_c']) || !empty($_REQUEST['id_c']))) 
                {
                    Cani\aggiungi($_REQUEST['nome'], $_REQUEST['data_n'], $_REQUEST['data_v']);
                }
            break;

        case 'modifica':
            if(isset($_REQUEST['nome']) && isset($_REQUEST['data_n']) && isset($_REQUEST['data_v']) 
                && (isset($_REQUEST['id_c']) && !empty($_REQUEST['id_c']))) 
                {
                    Cani\modifica($_REQUEST['id_c'], $_REQUEST['nome'], $_REQUEST['data_n'], $_REQUEST['data_v']);
                }
            break;

        case 'elimina':
            if (isset($_REQUEST['id_c'])) 
            
                {
                    Cani\elimina($_REQUEST['id_c']);
                }
            break;
    }