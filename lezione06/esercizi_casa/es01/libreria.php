<?php

    # funzione render un pò più complessa
    function render_2($template, $array1, $array2) {

        $stringa = file_get_contents($template);

        switch (True) {
            case !isset($array2):
                foreach ($array1 as $key => $value) {
                    $stringa = str_replace('{{' . $key . '}}' , $value, $stringa);
                break;
                }
            
            case isset($array2):
                foreach ($array1 as $key => $value) {
                    $stringa = str_replace('{{' . $key . '}}' , $value, $stringa);
                }

                foreach ($array2 as $key => $value) {
                    $stringa = str_replace('{{' . $key . '}}' , $value, $stringa);
                break;
                }
        }

        return $stringa;
    };


    # funzione render semplice
    function render_1($template, $array1) {

        $stringa = file_get_contents($template);

        foreach ($array1 as $key => $value) {
            $stringa = str_replace('{{' . $key . '}}' , $value, $stringa);
        }
                
        return $stringa;
    };

    function creaCampi ($placeholder, $array_campi, $output) {

        $campi = '';      

        foreach ($array_campi as $key => $value) {
            $campi .= '<label>' . $value . '</label><br><input type="text" name="' . $key . '"><br><br>';
        }

        return str_replace($placeholder, $campi, $output);


    }
