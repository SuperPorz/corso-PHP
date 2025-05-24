<?php

    require_once "libreria.php";

    #CALCOLI TRIANGOLO

    if (isset($_POST["base"]) && isset($_POST["altezza"])) {
        $base = $_POST["base"];
        $altezza = $_POST["altezza"];
        echo '<p>L\'area della figura è: </p>' . 
            '<h1>' . areaTriangolo ($base, $altezza ) . '</h1>';
    }

