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

    function render($template, $search, $replace){
        $x = $template;
        $x = str_replace($search,$replace, $x);
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

    ######################## LETTURA #########################################

    $database = file_get_contents("lista.db");

    if (empty($database)) {
        $lista = [ ];
        $somma = 0;
    } elseif (!empty($database)) {
        $lista = unserialize( file_get_contents('lista.db'));
        $somma = somma_1($lista);
    }

    ######################  SCRITTURA   ########################################

    if( isset($_POST['descrizione']) && isset($_POST['prezzo'])) {

        $lista[ ] = array(
            $_POST['descrizione'] => floatval($_POST['prezzo']),
        );

        #serializzo la lista e la scrivo sul file di database
        file_put_contents('lista.db', serialize($lista));          
    }

    ######################  RENDERING   ########################################

    $str = ciclo_lista($lista);        
    $template = file_get_contents('template.html');
    $render = render($template, '{{lista}}', $str); 
    $render = render($render, '{{spesa}}', $somma);  
    echo $render;  