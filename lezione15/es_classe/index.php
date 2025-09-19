<?php

    # INCLUDES
    include 'classes/auto.php';
    include 'classes/parcheggio.php';
    include 'classes/sosta.php';


    # ISTANZE
    $parcheggio1 = new Parcheggio('San Francesco', 8); //aggiungo 1 parcheggo
    $auto1 = new Auto('XC532WE', 'Mario');
    $auto2 = new Auto('FD890TY', 'Sandra');
    $auto3 = new Auto('UI602JK', 'Giovanni');

    $sosta1 = new Sosta($auto1, $parcheggio1);
    $sosta2 = new Sosta($auto2, $parcheggio1);
    $sosta3 = new Sosta($auto3, $parcheggio1);


    # CALCOLI
    $lista_auto = [$auto1, $auto2, $auto3];
    $soste_aperte = [$sosta1->lista_soste, $sosta2->lista_soste, $sosta2->lista_soste];

    //chiudo alcune soste
    $sosta1->termina_sosta('XC532WE');
    $sosta2->termina_sosta('FD890TY');
    $soste_concluse = [ $sosta1, $sosta2];
    
    //calcolo tariffe
    $parcheggio1->calcola_tariffa($sosta1);
    
    $soste_pagate = $parcheggio1->soste_pagate;


    # RENDER
    $render = file_get_contents('tpl/index.html');
    /* $render = str_replace('lista_parcheggi', $parcheggio1->nome_parcheggio, $render);
    $render = str_replace('lista_auto', $lista_auto, $render);
    $render = str_replace('soste_aperte', $sosta3->lista_soste, $render);
    $render = str_replace('soste_concluse', $soste_concluse, $render);
    $render = str_replace('soste_pagate', $soste_pagate, $render); */
    echo $render;

    echo ' <br><strong> lista parcheggi: </strong><br>';
    echo $parcheggio1->nome_parcheggio .'<br>';
    echo ' <br><strong> lista auto: </strong><br>';
    print_r($lista_auto) .'<br>';
    echo ' <br><strong> soste_aperte: </strong><br>';
    print_r($sosta3->lista_soste) .'<br>';
    echo ' <br><strong> soste_concluse: </strong><br>';
    print_r($soste_concluse) .'<br>';
    echo ' <br><strong> soste_pagate: </strong><br>';
    print_r($soste_pagate) .'<br>';


   /*  foreach ($lista_auto as $auto) {
        print_r($auto['targa']) .'<br>';
    } */


    


