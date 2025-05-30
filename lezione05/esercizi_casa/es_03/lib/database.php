<?php


    $saloneAuto = array(
        0 => array(
            "modello"=> "BMW Serie 1",
            "base"=> "29'000€",
            "standard"=> "36'000€",
            "lusso"=> "41'000€",
        ),

        1 => array(
            "modello"=> "Mercedes Classe A",
            "base"=> "39'000€",
            "standard"=> "47'000€",
            "lusso"=> "68'000€",
        ),

        2 => array(
            "modello"=> "Fiat Punto EVO GPL",
            "base"=> "9'500€",
            "standard"=> "12'000€",
            "lusso"=> "15'500€",
        ),

        3 => array(
            "modello"=> "Audi RS3 Sportback",
            "base"=> "54'000€",
            "standard"=> "62'000€",
            "lusso"=> "84'000€",
        ),

    );


    $pagine = array(
        0 => array(
            'titolo' => 'not found',
            'h1' => 'Pagina non trovata',
            'contenuto' => 'Pagina non trovata',
            'template' => 'index.html'
        ),
        1 => array(
            'titolo' => 'Salone Auto',
            'h1' => 'Michelangelo Showroom - Auto a prezzi abbordabili!!!',
            'contenuto' => 'Scegli un modello di auto tra quelli disponibili nel salore: ',
            'template' => 'index.html',
        ),
        2 => array(
            'titolo' => 'Selezione Allestimenti',
            'h1' => 'Allestimenti disponibili per il modello selezionato',
            'contenuto' => 'Scegli quale allestimento desideri per il modello scelto, clicca invia e scopri il prezzo: ' ,
            'template' => 'allestimenti.html',
        ),

        3 => array(
            'titolo' => 'Prezzo Modello',
            'h1' => 'Hai scelto modello di veicolo e prezzo!!!',
            'contenuto' => ' ??? ' ,
            'template' => 'prezzo.html',
        ),
    );


    $allestimenti = array(

        "base" => "allestimento base",
        "standard" => "allestimento standard",
        "lusso" => "allestimento lusso",

    );