<?php

    require_once "libreria.php";


    #CALCOLI CERCHIOTRIANGOLO

    if (isset($_POST["raggio"])) {
        $raggio = $_POST["raggio"];
        echo '<p>L\'area della figura è: </p>' .
            '<h1>' . areaCerchio ($raggio) . '</h1>';
    };

