<?php

 ############################# FUNZIONI  ##########################

    function ciclo_lista($array) {
        $elementi_lista = '';
            foreach ($array as $k => $val) {
                foreach ($val as $k2 => $v2) {
                    $elementi_lista .= '<li>' . $k2 . ' -------> ' .$v2 . '</li>';
                } 
            }
        return $elementi_lista;
    }

    function render($stringaHTML, $search, $replace){
        $x = $stringaHTML;
        $x = str_replace($search,$replace, $x);
        return $x;
    }

    function conta_squadre($array){
        $x = count($array);
        return $x;
    }
    
    function aggiunta_scrittura_elementi($squadra, $punti) {

        $array_lista = unserialize( file_get_contents('lista.db'));

        $array_lista[ ] = array(
                $squadra => (int)$punti,
            );
        file_put_contents('lista.db', serialize($array_lista));
    }                 

 ######################## LETTURA #########################################

    $database = file_get_contents("lista.db");

 ######################  MAIN PROGRAM   ########################################

    if (empty($database)) {

        $lista = [ ];
        $num_squadre = 0;
        $nome_vincente = '';
        $stringa_retrocesse = '';   

        if (isset($_POST['nome_squadra']) && isset($_POST['punti'])) { //se $_POST è settato:

            aggiunta_scrittura_elementi($_POST['nome_squadra'], $_POST['punti']);                  
        }

    } elseif (!empty($database)) {

        $lista = unserialize( file_get_contents('lista.db')); 

        $num_squadre = conta_squadre($lista);

        if (isset($_POST['nome_squadra']) && isset($_POST['punti'])) { //se $_POST è settato:

            aggiunta_scrittura_elementi($_POST['nome_squadra'], $_POST['punti']);                  
        } 

        if ((int)$num_squadre < 4) {            
            $nome_vincente = '';
            $stringa_retrocesse = '';

        } else {
        
            $lista_classifica = [ ]; // mi creo una copia di $lista per poter effettuare i sort senza disturbare lista originale
            foreach ($lista as $k => $val) {
                foreach ($val as $nome_squadra => $punteggio) {
                    $lista_classifica[$nome_squadra] = $punteggio;
                } 
            }

            # calcoli vincente e retrocesse
            asort($lista_classifica); // restituisce array ordinato per valori crescenti
            $nome_vincente = array_key_last($lista_classifica); // mi calcolo la vincente
            $retrocesse_array = array_slice($lista_classifica, 0, 4, true); // Le retrocesse sono le prime 4 squadre dell'array fornito dalla funz "asort" (punteggi crescenti)
            $nomi_retrocesse = array_keys($retrocesse_array);
            $stringa_retrocesse = implode(', ', $nomi_retrocesse);
        }
    }

 ################################  RENDERING   ##################################

    $lista = unserialize( file_get_contents('lista.db')); 

    if ($lista == [ ]){
        $str = '';
    } else {
        $str = ciclo_lista($lista);
    }
    
    $render = file_get_contents('template.html'); 
    $render = render($render, '{{lista_squadra}}', $str);  
    $render = render($render, '{{vincente}}', $nome_vincente);
    $render = render($render, '{{retrocesse}}', $stringa_retrocesse); 
    echo $render;

 ################################## FINE PROG ####################################   
