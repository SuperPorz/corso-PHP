<?php

    function render_2($template, $array) {

        $stringaHTML = file_get_contents($template);

        foreach ($array as $key => $value) {
            $stringaHTML = str_replace('{{' . $key . '}}', $value, $stringaHTML);
        }
        
        return $stringaHTML;
    }

    
    $pagine = array (

        0 => array (
            'titolo' => 'Somma di due numeri',
            'contenuto' => 'Inserisci due numeri di cui calcolare la somma',
        ),

        1 => array (
            'titolo' => 'Risultato operazione',
            'contenuto' => 'Il risultato della somma è: '        )
    );


    function render_1($template, $array, $risultato) {

        $stringaHTML = file_get_contents($template);

        foreach ($array as $key => $value) {
            $stringaHTML = str_replace('{{' . $key . '}}', $value, $stringaHTML);
        }

        
        $stringaHTML = str_replace('{{risultato}}', $risultato, $stringaHTML);
        
        
        return $stringaHTML;
    }
    