<?php

    ############################# FUNZIONI ################################
    function get_file($template) {
        $x = file_get_contents($template);
        return $x;
    }

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
        $x = get_file($template);
        $x = str_replace($search,$replace, $x);
        echo $x;
    }

    ######################## LETTURA #########################################

    $database = get_file("lista.db");

    if (empty($database)) {
        $lista = [ ];

    } elseif (!empty($database)) {

        $lista = unserialize( file_get_contents('lista.db'));
    }

    ######################## SCRITTURA #########################################

    if( !isset($_POST['prodotto']) && !isset($_POST['quantita'])) { 

            $str = ciclo_lista($lista);

            render('template.html', '{{lista}}', $str);          

    } else {
            
        $lista[ ] = array(
            $_POST['prodotto'] => $_POST['quantita'],
        );
    
        file_put_contents('lista.db', serialize($lista));

        $str = ciclo_lista($lista);

        render('template.html', '{{lista}}', $str);
    }


