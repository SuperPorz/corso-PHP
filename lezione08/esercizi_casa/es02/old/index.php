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
            
            #compilo la lista vuota
            $lista[ ] = array(
                $_POST['descrizione'] => floatval($_POST['prezzo']),
            );
        
            #serializzo la lista e la scrivo sul file di database
            file_put_contents('lista.db', serialize($lista));

            # CONCATENO PRODOTTI E prezzo' IN UNA STRINGA E LA ASSEGNO AD UNA VARIABILE ($str)
            $str = '';
            foreach ($lista as $k => $val) {
                foreach ($val as $k2 => $v2) {
                    $str = '<span>' . $k2 . ' => ' .$v2 . ' €</span><br><a>';
                } 
            }

            #calcolo la somma delle voci di spesa
            $somma = somma_1($lista);
            file_put_contents('cache/somma.txt', $somma); //inserisco il valore somma su un file temporaneo
            
            # OPERAZIONI VARIE SULLE STRINGHE PER MANIPOLARE L'OUTPUT DI RENDERING
            $render = template_HTML('template.html'); // trasformo il template HTML in stringa e la assegno ad una variabile
            $render = str_replace('<span></span>',$str, $render); // sostituisco un placeholder con la stringa concatenata che mi crea la LISTA  
            $render = str_replace('<h3>SPESA TOTALE: __ €</h3>','<h3>SPESA TOTALE: ' .$somma . '€</h3>', $render); //sostituisco placeholder con la somma calcolata          
            file_put_contents('cache/cache.html', $render); #scrivo la stringa su un file temporaneo
            echo $render;
        }

    # SE LA LISTA SPESA NON E' VUOTA:
    } elseif (!empty($database)) {
        
        $lista = unserialize( file_get_contents('lista.db'));

        //se $_POST è settato:
        if (isset($_POST['descrizione']) && !empty($_POST['descrizione']) && isset($_POST['prezzo']) && !empty($_POST['prezzo'])) {

            #compilo la lista vuota
            $lista[ ] = array(
                $_POST['descrizione'] => floatval($_POST['prezzo']),
            );

            #serializzo la lista e la scrivo sul file di database
            file_put_contents('lista.db', serialize($lista));

            #calcolo la somma delle voci di spesa
            $somma = somma_1($lista);
            $read  = file_get_contents('cache/somma.txt');// leggo l'ultimo valore somma e lo inserisco in una variabile
            file_put_contents('cache/somma.txt', ''); // svuoto il file della somma (tanto ho il valore memorizzato)
            file_put_contents('cache/somma.txt', $somma); // inserisco il NUOVO valore somma sul file temporaneo
        
            # CONCATENO PRODOTTI E PREZZO IN UNA STRINGA E LA ASSEGNO AD UNA VARIABILE ($str2)
            $str2 = '';
            foreach ($lista as $k => $val) {
                foreach ($val as $k2 => $v2) {
                    $str2 = '<span>' . $k2 . ' => ' .$v2 . ' €</span><br><a>';
                } 
            }

            # OPERAZIONI VARIE SULLE STRINGHE PER MANIPOLARE L'OUTPUT DI RENDERING
            $stringa_somma_vecchia = '<h3>SPESA TOTALE: ' .$read . '€</h3>'; // assegno a variabile: stringa HTML contenente VECCHIA somma
            $stringa_somma_nuova = '<h3>SPESA TOTALE: ' .$somma . '€</h3>'; // assegno a nuova variabile: stringa HTML contenente NUOVA somma
            $render2 = template_HTML('cache/cache.html'); // trasformo il file di CACHE HTML in stringa e la assegno ad una variabile
            $render2 = str_replace('<a>',$str2, $render2); // sostituisco placeholder con stringa concatenata che mi AGGIORNA la lista
            $render2 = str_replace($stringa_somma_vecchia,$stringa_somma_nuova, $render2); // cerco stringa con ID somma vecchia e sostituisco            
            file_put_contents('cache/cache.html', ''); // svuoto il file temporaneo
            file_put_contents('cache/cache.html', $render2); // poi ci scrivo la stringa HTML aggiornata
            echo $render2;

        } else {
            // Se non ci sono nuovi dati POST, mostro semplicemente la cache esistente
            echo template_HTML('cache/cache.html');
        }
    }
