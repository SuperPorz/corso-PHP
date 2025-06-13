<?php

    ############# inizializzazione: LETTURA DEI FILES e FUNZIONI  ##################

    function template_HTML($template) {
        $x = file_get_contents($template);
        return $x;
    }

    function somma_1($array) {
        $tot = 0;
            foreach ($array as $k => $v) {
                foreach ($v as $key => $value){
                    $tot += (float)$value;
                } 
            }  
        return $tot;
    }

    $database = template_HTML("lista.db");

    ######################  MAIN PROGRAM   ########################################
    # SE LA LISTA SPESA E' VUOTA:
    if (empty($database)) {
        $lista = [ ];

        if( !isset($_POST['descrizione']) && !isset($_POST['prezzo'])) { //se $_POST è settato:

            echo template_HTML('template.html');  //semplice render del template (originale)         

        } else { //se $_POST non è settato:
            
            #compilo la lista
            $lista[ ] = array(
                $_POST['descrizione'] => floatval($_POST['prezzo']),
            );

            #serializzo la lista e la scrivo sul file di database
            file_put_contents('lista.db', serialize($lista));        

            # CONCATENO PRODOTTI E prezzo' IN UNA STRINGA E LA ASSEGNO AD UNA VARIABILE ($str)
            $str = '';
            foreach ($lista as $k => $val) {
                foreach ($val as $k2 => $v2) {
                    $str .= '<li>' . $k2 . ' => ' .$v2 . ' €</li>';
                } 
            }

            #calcolo la somma delle voci di spesa
            $somma = somma_1($lista);
            
            # OPERAZIONI VARIE SULLE STRINGHE PER MANIPOLARE L'OUTPUT DI RENDERING
            $render = template_HTML('template.html'); // trasformo il template HTML in stringa e la assegno ad una variabile
            $render = str_replace('{{lista}}',$str, $render); // sostituisco un placeholder con la stringa concatenata che mi crea la LISTA  
            $render = str_replace('{{spesa}}',$somma, $render); //sostituisco placeholder con la somma calcolata          
            echo $render;
        }

    # SE LA LISTA SPESA NON E' VUOTA:
    } elseif (!empty($database)) {
        
        $lista = unserialize( file_get_contents('lista.db'));

        //se $_POST è settato:
        if (isset($_POST['descrizione']) && !empty($_POST['descrizione']) && isset($_POST['prezzo']) && !empty($_POST['prezzo'])) {

            #compilo la lista
            $lista[ ] = array(
                $_POST['descrizione'] => floatval($_POST['prezzo']),
            );

            #serializzo la lista e la scrivo sul file di database
            file_put_contents('lista.db', serialize($lista));        

            # CONCATENO PRODOTTI E prezzo' IN UNA STRINGA E LA ASSEGNO AD UNA VARIABILE ($str)
            $str = '';
            foreach ($lista as $k => $val) {
                foreach ($val as $k2 => $v2) {
                    $str .= '<li>' . $k2 . ' => ' .$v2 . ' €</li>';
                } 
            }

            #calcolo la somma delle voci di spesa
            $somma = somma_1($lista);
            
            # OPERAZIONI VARIE SULLE STRINGHE PER MANIPOLARE L'OUTPUT DI RENDERING
            $render = template_HTML('template.html'); // trasformo il template HTML in stringa e la assegno ad una variabile
            $render = str_replace('{{lista}}',$str, $render); // sostituisco un placeholder con la stringa concatenata che mi crea la LISTA  
            $render = str_replace('{{spesa}}',$somma, $render); //sostituisco placeholder con la somma calcolata          
            echo $render;

        } else {
            // Se non ci sono nuovi dati POST, mostro semplicemente la cache esistente
            $lista = unserialize( file_get_contents('lista.db'));
            
            # CONCATENO PRODOTTI E prezzo' IN UNA STRINGA E LA ASSEGNO AD UNA VARIABILE ($str)
            $str = '';
            foreach ($lista as $k => $val) {
                foreach ($val as $k2 => $v2) {
                    $str .= '<li>' . $k2 . ' => ' .$v2 . ' €</li>';
                } 
            }

            #calcolo la somma delle voci di spesa
            $somma = somma_1($lista);
            
            # OPERAZIONI VARIE SULLE STRINGHE PER MANIPOLARE L'OUTPUT DI RENDERING
            $render = template_HTML('template.html'); // trasformo il template HTML in stringa e la assegno ad una variabile
            $render = str_replace('{{lista}}',$str, $render); // sostituisco un placeholder con la stringa concatenata che mi crea la LISTA  
            $render = str_replace('{{spesa}}',$somma, $render); //sostituisco placeholder con la somma calcolata          
            echo $render;
        }
    }
