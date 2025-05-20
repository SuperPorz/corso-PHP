<?php

    #area triangolo
    function areaTriangolo ($base, $altezza ) {
        return ($base * $altezza) / 2;
    };

    #area rettangolo
    function areaRettangolo ($lato1, $lato2 ) {
        return $lato1 * $lato2;
    };

    #area cerchio
    function areaCerchio ($raggio) {
        return ($raggio**2) * 3.14159;
    };