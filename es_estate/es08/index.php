<?php

    # COLLEZIONI DI DATI
    $destinazioni = [
        'Kiribati' => 255,
        'Papua Nuova Guinea' => 312,
        'Galapagos' => 188,
        'Hawaii' => 436,
        'Maldive' => 520,
        'Seychelles' => 647,
    ];

    $optionals = [
        'frigobar' => 85,
        'lenzuola seta' => 50,
        'payTV' => 125,
        'jacuzzi' => 360,
        'lavanderia' => 37,
        'internet' => 24,
        'escursione BASIC' => 84,
        'escursione PRO' => 128,
        'escursione VIP GOLD' => 240,
    ];


    # COSTRUZIONE SELECT (per le destinazioni)
    $options1 = '';
    foreach($destinazioni as $k => $v) {

        $options1 .= "<option value=\"" . $v . "\">" 
        . $k ." (" . $v ." €)" 
        . "</option>";
    }


    # AGGIUNTA OPTIONS TIPO CHECKBOX (per gli optionals)
    $options2 = '';
    foreach($optionals as $k => $v) {
        $options2 .= "<br><input 
            type=\"checkbox\" 
            id=\"input\" 
            name=\"" . $k ."\" " . 
            "value=\"". $v ."\" 
            placeholder=\"". $k ."\">" . 
            "<label for=\"" .$k ."\">" . $k . " (" . $v ." €)" ."</label>";
    }


    # CALCOLO COSTI
    $prezzo = 0;
    foreach($_POST as $k => $v) {
        $prezzo += $v;
    }


    # RENDER FINALE
    $render = file_get_contents('tpl/main.html');
    $render = str_replace('{{select1}}', $options1, $render);
    $render = str_replace('{{select2}}', $options2, $render);
    $render = str_replace('{{prezzo}}', $prezzo, $render);
    echo $render;
