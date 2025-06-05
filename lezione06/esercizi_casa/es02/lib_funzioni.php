<?php

    $pagine = array(
        0 => array(
            "titolo"=> "MAIN",
            "h1"=> "Benvenuto! Clicca sul link seguente per calcolare il tempo di percorrenza",
            "template"=> "main.html",
        ),

        1 => array(
            "titolo"=> "INPUT",
            "h1"=> "Compila i campi seguenti per calcolare il tempo di percorrenza",
            "template"=> "input.html",
        ),

        2 => array(
            "titolo"=> "OUTPUT",
            "h1"=> "Ottimo! Calcolo eseguito! ",
            "template"=> "output.html",
        ),
    
    );

    $campi = array(
        'campo1' => 'distanza (in Km)',
        'campo2' => 'velocità (in Km/h)',
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
            $campi .= '<label>' . $value . '</label><br><input type="text" name="' . $key . '"><br><br>';
        }

        return str_replace($placeholder, $campi, $output);

    }