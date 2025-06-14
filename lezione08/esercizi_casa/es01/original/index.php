<?php

    ################ inizializzazione: LETTURA DEI FILES e FUNZIONI

    function template_HTML($template) {
        $x = file_get_contents($template);
        return $x;
    }

    $database = template_HTML("lista.db");

    ####################################################################################
    # SE LA LISTA SPESA E' VUOTA:
    if (empty($database)) {
        $lista = [ ];

        # SCRITTURA FILE e RENDERIZZAZIONE
        if( !isset($_POST['prodotto']) && !isset($_POST['quantita'])) { 

            echo template_HTML('template.html');            

        } else {
            
            $lista[ ] = array(
                $_POST['prodotto'] => $_POST['quantita'],
            );
        
            file_put_contents('lista.db', serialize($lista));

            # CONCATENO PRODOTTI E QUANTITA' IN UNA STRINGA E LA ASSEGNO AD UNA VARIABILE
            foreach ($lista as $k => $val) {
                foreach ($val as $k2 => $v2) {
                    $str = '<span>' . $k2 . ' => ' .$v2 . '</span><br><a>';
                } 
            }

            # INSERISCO LA STRINGA HTML NEL FILE TEMPLATE SOSTITUENDO IL PLACEHOLDER
            $render = template_HTML('template.html');
            $render = str_replace('<span></span>',$str, $render);
            file_put_contents('cache.html', $render); #scrivo la stringa su un file temporaneo
            echo $render;
        }

    # SE LA LISTA SPESA NON E' VUOTA:
    } elseif (!empty($database)) {
        
        $lista = unserialize( file_get_contents('lista.db'));

        # SCRITTURA FILE e RENDERIZZAZIONE
        if (isset($_POST['prodotto']) && !empty($_POST['prodotto']) && isset($_POST['quantita']) && !empty($_POST['quantita'])) {

            $lista[ ] = array(
                $_POST['prodotto'] => $_POST['quantita'],
            );
        
            # CONCATENO PRODOTTI E QUANTITA' IN UNA STRINGA E LA ASSEGNO AD UNA VARIABILE
            foreach ($lista as $k => $val) {
                foreach ($val as $k2 => $v2) {
                    $str2 = '<span>' . $k2 . ' => ' .$v2 . '</span><br><a>';
                } 
            }

            file_put_contents('lista.db', serialize($lista));

            # INSERISCO LA STRINGA HTML NEL FILE TEMPLATE SOSTITUENDO IL PLACEHOLDER
            $render2 = template_HTML('cache.html'); 
            $render2 = str_replace('<a>',$str2, $render2);
            file_put_contents('cache.html', ''); #prima svuoto il file temporaneo
            file_put_contents('cache.html', $render2); #poi ci scrivo la stringa HTML aggiornata
            echo $render2;
        } else {
            // Se non ci sono nuovi dati POST, mostro semplicemente la cache esistente
            echo template_HTML('cache.html');
        }
    }
