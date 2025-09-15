<?php

    # REQUIRE
    require 'class/veicoli.php';
    require 'class/auto.php';
    require 'class/moto.php';
    require 'class/camion.php';


    # ISTANZE
    $moto = new Moto('CX345PO', 'Marco', 'KAWASAKI');
    $auto = new Auto('WE765LI', 'Francesca', 'FIAT PUNTO');
    $camion = new Camion('RT332VB', 'Carlo', 'IVECO STRALIS');


    # RENDER
    // moto
    foreach ($moto->getDati() as $key => $value) {
        echo $key . ': ' . $value . '<br>';
    }
    echo '<br><br>';

    // auto
    foreach ($auto->getDati() as $key => $value) {
        echo $key . ': ' . $value . '<br>';
    }
    echo '<br><br>';

    // camion
    foreach ($camion->getDati() as $key => $value) {
        echo $key . ': ' . $value . '<br>';
    }
    echo '<br><br>';
    

