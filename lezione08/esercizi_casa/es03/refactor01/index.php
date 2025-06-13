<?php

    ############# inizializzazione: LETTURA DEI FILES e FUNZIONI  ##################

    function get_file($template) {
        $x = file_get_contents($template);
        return $x;
    }

    function conta_squadre($array){
        $x = count($array);
        return $x;
    }

    $database = get_file("lista.db");

    if (empty($database)){
        $num_squadre = 0;
    } else {
        $lista = unserialize( file_get_contents('lista.db'));
        $num_squadre = conta_squadre($lista);
    }

    ######################  MAIN PROGRAM   ########################################
    # SE LA CLASSIFICA E' VUOTA:
    if (empty($database)) {
        $lista = [ ];

        if( !isset($_POST['nome_squadra']) && !isset($_POST['punti'])) { //se $_POST è settato:

            echo get_file('template.html');  //semplice render del template (originale)         

        } else { //se $_POST non è settato:
            
            #compilo la lista vuota
            $lista[ ] = array(
                $_POST['nome_squadra'] => (int)$_POST['punti'],
            );
        
            #serializzo la lista e la scrivo sul file di database
            file_put_contents('lista.db', serialize($lista));

            # CONCATENO PRODOTTI E punti IN UNA STRINGA E LA ASSEGNO AD UNA VARIABILE ($str)
            $str = '';
            foreach ($lista as $k => $val) {
                foreach ($val as $k2 => $v2) {
                    $str .= '<li>' . $k2 . ' => ' .$v2 . '</li>';
                } 
            }
            
            # OPERAZIONI VARIE SULLE STRINGHE PER MANIPOLARE L'OUTPUT DI RENDERING
            $render = get_file('template.html'); // trasformo il template HTML in stringa e la assegno ad una variabile
            $render = str_replace('{{classifica}}',$str, $render); // sostituisco un placeholder con la stringa concatenata che mi crea la LISTA  
            echo $render;

        }

    # SE LA CLASSIFICA NON E' VUOTA E CI SONO MENO DI 5 ELEMENTI IN ESSA:
    } elseif (!empty($database) && (int)$num_squadre < 4) {
        
        $lista = unserialize( file_get_contents('lista.db'));

        //se $_POST è settato:
        if (isset($_POST['nome_squadra']) && !empty($_POST['nome_squadra']) && isset($_POST['punti']) && !empty($_POST['punti'])) {

            #compilo la lista
            $lista[ ] = array(
                $_POST['nome_squadra'] => (int)$_POST['punti'],
            );

            #serializzo la lista e la scrivo sul file di database
            file_put_contents('lista.db', serialize($lista));
            var_dump($lista);
        
            # CONCATENO PRODOTTI E punti IN UNA STRINGA E LA ASSEGNO AD UNA VARIABILE ($str)
            $str = '';
            foreach ($lista as $k => $val) {
                foreach ($val as $k2 => $v2) {
                    $str .= '<li>' . $k2 . ' => ' .$v2 . '</li>';
                } 
            }

            # OPERAZIONI VARIE SULLE STRINGHE PER MANIPOLARE L'OUTPUT DI RENDERING 
            $render = get_file('template.html');           
            $render = str_replace('{{classifica}}',$str, $render); // sostituisco placeholder con stringa concatenata che mi AGGIORNA la lista
            echo $render;

        } else {
        
            # CONCATENO PRODOTTI E punti IN UNA STRINGA E LA ASSEGNO AD UNA VARIABILE ($str)
            $str = '';
            foreach ($lista as $k => $val) {
                foreach ($val as $k2 => $v2) {
                    $str .= '<li>' . $k2 . ' => ' .$v2 . '</li>';
                } 
            }

            # OPERAZIONI VARIE SULLE STRINGHE PER MANIPOLARE L'OUTPUT DI RENDERING
            $render = get_file('template.html');            
            $render = str_replace('{{classifica}}',$str, $render); // sostituisco placeholder con stringa concatenata che mi AGGIORNA la lista
            echo $render;
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
        
            # CONCATENO PRODOTTI E punteggio IN UNA STRINGA E LA ASSEGNO AD UNA VARIABILE ($str)
            $str = '';
            $lista_classifica = [ ]; // Array associativo: nome_squadra => punteggio

            foreach ($lista as $k => $val) {
                foreach ($val as $nome_squadra => $punteggio) {
                    $str .= '<li>' . $nome_squadra . ' => ' . $punteggio . '</li>';
                    $lista_classifica[$nome_squadra] = $punteggio;
                } 
            }
            ////////////////////////////////////////////////////////////////
            ##### CALCOLI VINCENTE + RETROCESSE ########

                // Ordino per punteggio crescente mantenendo l'associazione nome=>punteggio
                asort($lista_classifica);

                // Il vincente è quello con il punteggio più alto (ultimo dopo il sort crescente)
                $nome_vincente = array_key_last($lista_classifica);

                // Le retrocesse sono le prime 4 squadre dell'array fornito dalla funz "asort" (punteggi crescenti)
                $retrocesse_array = array_slice($lista_classifica, 0, 4, true);
                $nomi_retrocesse = array_keys($retrocesse_array);
                $stringa_retrocesse = implode(', ', $nomi_retrocesse);

            # PROCEDIAMO CON IL RENDER SU TEMPLATE
            $render3 = get_file('template.html');
            $render3 = str_replace('{{classifica}}', $str, $render3); //renderizziamo la lista squadre
            $render3 = str_replace('{{vincente}}', $nome_vincente, $render3); //renderizziamo la vincente
            $render3 = str_replace('{{retrocesse}}', $stringa_retrocesse, $render3); // renderizziamo retrocesse          
            echo $render3;

        } else {        
            # CONCATENO PRODOTTI E punti IN UNA STRINGA E LA ASSEGNO AD UNA VARIABILE ($str)
            $str = '';
            foreach ($lista as $k => $val) {
                foreach ($val as $k2 => $v2) {
                    $str .= '<li>' . $k2 . ' => ' .$v2 . '</li>';
                } 
            }

            # OPERAZIONI VARIE SULLE STRINGHE PER MANIPOLARE L'OUTPUT DI RENDERING  
            $render = get_file('template.html');          
            $render = str_replace('{{classifica}}',$str, $render); // sostituisco placeholder con stringa concatenata che mi AGGIORNA la lista
            echo $render;
        }
    }
