<?php

    $pagine = array(
        0 => array(
            "titolo"=> "INDEX",
            "h1"=> "Benvenuto! Clicca sul link per avviare il programma di calcolo",
            "template"=> "tpl/index.html",
        ),

        1 => array(
            "titolo"=> "FIGURE",
            "h1"=> "Scegli una figura tra quelle proposte",
            "template"=> "tpl/scelta_figure.html",
        ),

        2 => array(
            "titolo"=> "PARAMETRI",
            "h1"=> "Bene! Ora compila i campi richiesti per il calcolo scelto",
            "template"=> "tpl/parametri.html",
        ),

        3 => array(
            "titolo"=> "CALCOLO",
            "h1"=> "Ben fatto! Un ultimo passo: scegli quale calcolo eseguire tra AREA e PERIMETRO",
            "template"=> "tpl/scelta_calcolo.html",
        ),

        4 => array(
            "titolo"=> "OUTPUT",
            "h1"=> "Ottimo! Calcolo eseguito!",
            "template"=> "tpl/output.html",
        ),
    
    );

    $campi = array(

        #ramo campi triangolo  
        0 => array(                
            'campo1' => 'cateto1',
            'campo2' => 'cateto2',
        ),

        #ramo campi rettangolo 
        1 => array(
            'campo1' => 'lato1',
            'campo2' => 'lato2',
        ),

        #ramo campi cerchio
        2 => array(
            'campo1' => 'raggio',
        ),
    );

    $figure = array(
        0 => 'triangolo',
        1 => 'rettangolo',
        2 => 'cerchio',
    );


    $calcolo = array(
        0 => 'area',
        1 => 'perimetro',
    );

    function render($template, $dati) {

        $contenuto = file_get_contents($template);

        foreach ($dati as $key => $value) {
            $contenuto = str_replace("{{". $key ."}}", $value, $contenuto);
        }

        return $contenuto;

    }


    function creaCampi ($placeholder, $array_campi, $output) {

        $campi = '';      

        foreach ($array_campi as $key => $value) {
            $campi .= '<label>' . $value . '</label><br><input type="text" name="' . $value . '"><br><br>';
        }
        $key = '';

        return str_replace($placeholder, $campi, $output);

    }

    function creaSelect ($placeholder, $array_opzioni, $output) {

        $opzioni = '';      

        foreach ($array_opzioni as $key => $value) {
            $opzioni .= '<option value="' . $key . '">' . $value . '</option>';
        }

        return str_replace($placeholder, $opzioni, $output);

    }