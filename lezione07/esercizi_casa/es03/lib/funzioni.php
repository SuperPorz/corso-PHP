<?php

    # FUNZIONE CHE RENDERIZZA I TEMPLATE HTML SOSTITUENDO I AI PLACEHOLDERS, VALORI INDICATI IN DATABASE.PHP
    function render($template, $dati) {

        $contenuto = file_get_contents($template);

        foreach ($dati as $key => $value) {
            $contenuto = str_replace($key, $value, $contenuto);
        }

        return $contenuto;
    }

    # FUNZIONE CHE CREA IL CODICE HTML DEI MENU A TENDINA
    function creaSelect($placeholder, $valori, $output) {

        $select = '';

        foreach ($valori as $key => $value) {
            $select .= '<option value="' . $key . '">' . $value . '</option>';
        }

        return str_replace($placeholder, $select, $output);
    }

    # FUNZIONE CHE CALCOLA LA SOMMA DEI PREZZI DI OGNI PORTATA (primo+secondo+dolce)
    function somma($val1, $val2, $val3) {

        return $val1 + $val2 + $val3;
    }

    # FUNZIONE CHE CREA LISTA DEI NOMI DI CIASCUNA PORTATA, VIENE POI UTILIZZATA PER CREARE I MENU A TENDINA
    function crea_array_piatti($array1) {

        $nomi_piatti = [ ];
        $i = 0;
        foreach ($array1 as $key => $value) {
            $nomi_piatti[$i] = $value['nome'];
            $i++;
        }
        return $nomi_piatti;

    }
