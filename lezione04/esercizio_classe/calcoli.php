<?php

    #require "subindex.php";
    require "librerie.php";

    #CALCOLI
   

    #triangolo
    if (isset($_POST["base"]) && isset($_POST["altezza"])) {
        $base = $_POST["base"];
        $altezza = $_POST["altezza"];
        echo '<p>L\'area della figura è: </p>' . 
            '<h1>' . areaTriangolo ($base, $altezza ) . '</h1>';
    }

    #rettangolo
    if (isset($_POST["lato1"]) && isset($_POST["lato2"])) {
        $lato1 = $_POST["lato1"];
        $lato2 = $_POST["lato2"];
        echo '<p>L\'area della figura è: </p>' .
            '<h1>' . areaRettangolo ($lato1, $lato2 ) .'<h1>';
    }

    #cerchio
    if (isset($_POST["raggio"])) {
        $raggio = $_POST["raggio"];
        echo '<p>L\'area della figura è: </p>' .
            '<h1>' . areaCerchio ($raggio) . '<h1>';
    };