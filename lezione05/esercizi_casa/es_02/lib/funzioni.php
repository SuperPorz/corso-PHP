<?php

    # FUNZIONE PER CALCOLO DISTANZA TRA DUE PUNTI FORNITI CON COORDINATE CARTESIANE

    function distanza_punti($array) {

        # Estraggo le coordinate dal form e le assegno a variabili separate, comode da usare dopo nella formula
        $x1 = $array['variabX1'];
        $y1 = $array['variabY1'];
        $x2 = $array['variabX2'];
        $y2 = $array['variabY2'];
        
        # Calcolo della distanza con la formula matematica appropriata
        $temp = sqrt(($x2 - $x1)**2 + ($y2 - $y1)**2);
        return round($temp, 3);

    }


    # FUNZIONE PER CALCOLO DISTANZA TRA DUE PUNTI FORNITI CON COORDINATE CARTESIANE

    function render($template, $dati) {

        // leggo il contenuto del template
        $contenuto = file_get_contents($template);

        // sostituisco i segnaposto con i dati della pagina
        foreach ($dati as $key => $value) {
            $contenuto = str_replace('{{' . $key . '}}', $value, $contenuto); 
        }

        // rappresento il template
        return $contenuto;
    }
