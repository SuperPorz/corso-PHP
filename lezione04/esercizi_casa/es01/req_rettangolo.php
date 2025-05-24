<?php

    require_once "libreria.php";

    #CALCOLI TRIANGOLO

    if (isset($_POST["lato1"]) && isset($_POST["lato2"])) {
        $lato1 = $_POST["lato1"];
        $lato2 = $_POST["lato2"];
        echo '<p>L\'area della figura è: </p>' .
            '<h1>' . areaRettangolo ($lato1, $lato2 ) .'</h1>';
    }

