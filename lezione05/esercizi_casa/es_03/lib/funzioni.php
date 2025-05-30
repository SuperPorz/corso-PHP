<?php

    # FUNZIONI PER RENDERIZZARE PAGINE

    

    function render_1($template, $dati) {

        // leggo il contenuto del template
        $contenuto = file_get_contents($template);

        // sostituisco i segnaposto con i dati della pagina
        foreach ($dati as $key => $value) {
            $contenuto = str_replace('{{' . $key . '}}', $value, $contenuto); 
        }

        // rappresento il template
        return $contenuto;
    }


    // funzione che crea una select
    function creaSelect($placeholder, $valori, $output) {

        // inizializzo la select
        $select = '';

        // creo le opzioni della select
        foreach ($valori as $key => $value) {
            $select .= '<option value="' . $key . '">' . $value . '</option>';
        }

        // sostituisco il segnaposto con la select
        return str_replace($placeholder, $select, $output);

    }

    # funzione che itera con foreach su due arrai passati come parametri
    function render_2($template2, $dati2, $dati3) {

        // leggo il contenuto del template
        $contenuto2 = file_get_contents($template2);

        // sostituisco i segnaposto con i dati della pagina
        foreach ($dati2 as $key => $value) {
            $contenuto2 = str_replace('{{' . $key . '}}', $value, $contenuto2); 
        }

        $contenuto3 = str_replace('{{prezzo}}', $dati3[$_POST['modello_selezionato']][$_POST['allestimento']], $contenuto2);

        // rappresento il template
        return $contenuto3;
    }

    /* function render_prezzo($template3, $array,) {

        $contenuto3 = file_get_contents($template3);
        return $contenuto3 = str_replace('{{prezzo}}', $array[$_POST['modello_selezionato']][$_POST['allestimento']], $contenuto3);
    } */