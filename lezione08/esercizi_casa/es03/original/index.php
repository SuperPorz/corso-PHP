<?php

    ############# inizializzazione: LETTURA DEI FILES e FUNZIONI  ##################

    function template_HTML($template) {
        $x = file_get_contents($template);
        return $x;
    }

    function conta_squadre($array){
        $x = count($array);
        return $x;
    }

    $database = template_HTML("lista.db");

    ######################  MAIN PROGRAM   ########################################
    # SE LA CLASSIFICA E' VUOTA:
    if (empty($database)) {
        $lista = [ ];

        if( !isset($_POST['nome_squadra']) && !isset($_POST['punti'])) { //se $_POST è settato:

            echo template_HTML('template.html');  //semplice render del template (originale)         

        } else { //se $_POST non è settato:
            
            #compilo la lista vuota
            $lista[ ] = array(
                $_POST['nome_squadra'] => (int)$_POST['punti'],
            );
        
            #serializzo la lista e la scrivo sul file di database
            file_put_contents('lista.db', serialize($lista));

            #calcolo il numero di squadre inserite e memorizzo in file temp 
            $num_squadre = conta_squadre($lista);
            file_put_contents('cache/conteggio.txt', $num_squadre); //inserisco il valore somma su un file temporaneo

            # CONCATENO PRODOTTI E punti IN UNA STRINGA E LA ASSEGNO AD UNA VARIABILE ($str)
            $str = '';
            foreach ($lista as $k => $val) {
                foreach ($val as $k2 => $v2) {
                    $str = '<span>' . $k2 . ' => ' .$v2 . '</span><br><a>';
                } 
            }
            
            # OPERAZIONI VARIE SULLE STRINGHE PER MANIPOLARE L'OUTPUT DI RENDERING
            $render = template_HTML('template.html'); // trasformo il template HTML in stringa e la assegno ad una variabile
            $render = str_replace('{{classifica}}',$str, $render); // sostituisco un placeholder con la stringa concatenata che mi crea la LISTA  
            file_put_contents('cache/cache.html', $render); #scrivo la stringa su un file temporaneo
            echo $render;

        }

    # SE LA CLASSIFICA NON E' VUOTA E CI SONO MENO DI 5 ELEMENTI IN ESSA:
    } elseif (!empty($database) && (int)file_get_contents('cache/conteggio.txt') < 4) {
        
        $lista = unserialize( file_get_contents('lista.db'));

        //se $_POST è settato:
        if (isset($_POST['nome_squadra']) && !empty($_POST['nome_squadra']) && isset($_POST['punti']) && !empty($_POST['punti'])) {

            #compilo la lista
            $lista[ ] = array(
                $_POST['nome_squadra'] => (int)$_POST['punti'],
            );

            #serializzo la lista e la scrivo sul file di database
            file_put_contents('lista.db', serialize($lista));

            #calcolo il numero di squadre inserite e memorizzo in file temp
            $lettura_num_squadre = (int)file_get_contents('cache/conteggio.txt'); // leggo il numero squadre inserito e lo assegno a una variabile
            $aggiorna_num_squadre = (int)conta_squadre($lista); // riconto le squadre inserite            
            file_put_contents('cache/conteggio.txt', ''); // svuoto il file temporaneo
            file_put_contents('cache/conteggio.txt', $aggiorna_num_squadre); //inserisco il nuovo numero di squadre contate nel file temporaneo
        
            # CONCATENO PRODOTTI E punti IN UNA STRINGA E LA ASSEGNO AD UNA VARIABILE ($str2)
            $str2 = '';
            foreach ($lista as $k => $val) {
                foreach ($val as $k2 => $v2) {
                    $str2 = '<span>' . $k2 . ' => ' .$v2 . '</span><br><a>';
                } 
            }

            # OPERAZIONI VARIE SULLE STRINGHE PER MANIPOLARE L'OUTPUT DI RENDERING            
            $render2 = template_HTML('cache/cache.html'); // trasformo il file di CACHE HTML in stringa e la assegno ad una variabile
            $render2 = str_replace('<a>',$str2, $render2); // sostituisco placeholder con stringa concatenata che mi AGGIORNA la lista
            file_put_contents('cache/cache.html', ''); // svuoto il file temporaneo
            file_put_contents('cache/cache.html', $render2); // poi ci scrivo la stringa HTML aggiornata
            echo $render2;

        } else {
            // Se non ci sono nuovi dati POST, mostro semplicemente la cache esistente
            echo template_HTML('cache/cache.html');
        }
    } else {
        
        $lista = unserialize( file_get_contents('lista.db'));

        //se $_POST è settato:
        if (isset($_POST['nome_squadra']) && !empty($_POST['nome_squadra']) && isset($_POST['punti']) && !empty($_POST['punti'])) {

            #compilo la lista
            $lista[ ] = array(
                $_POST['nome_squadra'] => (int)$_POST['punti'],
            );

            #serializzo la lista e la scrivo sul file di database
            file_put_contents('lista.db', serialize($lista));

            #calcolo il numero di squadre inserite e memorizzo in file temp
            $lettura_num_squadre = (int)file_get_contents('cache/conteggio.txt'); // leggo il numero squadre inserito e lo assegno a una variabile
            $aggiorna_num_squadre = (int)conta_squadre($lista); // riconto le squadre inserite            
            file_put_contents('cache/conteggio.txt', ''); // svuoto il file temporaneo
            file_put_contents('cache/conteggio.txt', $aggiorna_num_squadre); //inserisco il nuovo numero di squadre contate nel file temporaneo
        
            # CONCATENO PRODOTTI E punteggio IN UNA STRINGA E LA ASSEGNO AD UNA VARIABILE ($str2)
            $str2 = '';
            $lista_classifica = [ ]; // Array associativo: nome_squadra => punteggio

            foreach ($lista as $k => $val) {
                foreach ($val as $nome_squadra => $punteggio) {
                    $str3 = '<span>' . $nome_squadra . ' => ' . $punteggio . '</span><br><a>';
                    $lista_classifica[$nome_squadra] = $punteggio;
                } 
            }
            ////////////////////////////////////////////////////////////////
            ##### CALCOLI VINCENTE + RETROCESSE ########

            // Ordino per punteggio crescente mantenendo l'associazione nome=>punteggio
            asort($lista_classifica);

            // Il vincente è quello con il punteggio più alto (ultimo dopo il sort crescente)
            $nome_vincente = array_key_last($lista_classifica);

            // Le retrocesse sono le prime 4 squadre (punteggi più bassi)
            $retrocesse_array = array_slice($lista_classifica, 0, 4, true);
            $nomi_retrocesse = array_keys($retrocesse_array);

            # PROCEDIAMO CON IL RENDER SU TEMPLATE DI VINCENTE
            $render3 = template_HTML('cache/cache.html');
            $render3 = str_replace('<a>', $str3, $render3); //renderizziamo la lista squadre

            #sostituzione condizionale (per sostituire correttamente quando inviamo il form)
            $x = file_get_contents('cache/cache.html');
            if (str_contains($x, '{{vincente}}')) {

                $render3 = str_replace('{{vincente}}', $nome_vincente . '<!---->', $render3);
                file_put_contents('cache/vincente.txt', $nome_vincente);
            } 
            else {
                $render3 = str_replace('VINCENTE TORNEO: ' .file_get_contents('cache/vincente.txt'), 'VINCENTE TORNEO: ' .$nome_vincente . '<!---->', $render3);
                file_put_contents('cache/vincente.txt', $nome_vincente); 
            }

            # PROCEDIAMO CON IL RENDER SU TEMPLATE DELEL RETROCESSE
            // Creo una stringa con i nomi delle squadre retrocesse separate da virgola
            $stringa_retrocesse = implode(', ', $nomi_retrocesse);
            $render3 = str_replace('{{retrocesse}}', $stringa_retrocesse, $render3);

            #sostituzione condizionale (per sostituire correttamente quando inviamo il form)
            $y = file_get_contents('cache/cache.html');
            if (str_contains($y, '{{vincente}}')) {

                $stringa_retrocesse = implode(', ', $nomi_retrocesse);
                $render3 = str_replace('{{retrocesse}}', $stringa_retrocesse . '<!---->', $render3);
                file_put_contents('cache/retrocesse.txt', $stringa_retrocesse);
            } 
            else {
                $render3 = str_replace('SQUADRE RETROCESSE: ' .file_get_contents('cache/retrocesse.txt'), 'SQUADRE RETROCESSE: ' .$stringa_retrocesse . '<!---->', $render3);
                file_put_contents('cache/retrocesse.txt', $stringa_retrocesse); 
            }

            # SVUOTIAMO IL TEMPLATE CACHE HTML E LO RISCRIVIAMO CON LE MODIFICHE, POI RENDER FINALE
            file_put_contents('cache/cache.html', '');
            file_put_contents('cache/cache.html', $render3);
            echo $render3;

        } else {
            // Se non ci sono nuovi dati POST, mostro semplicemente la cache esistente
            echo template_HTML('cache/cache.html');
        }
    }
