<?php

    function area($param1, $param2) {

        switch (True) {
            case (array_key_exists('raggio', $_POST)):  #area del cerchio
                $area = $param1**2 * 3.14 ;
                break;

            case (array_key_exists('lato1', $_POST)):   #area del rettangolo
                $area = $param1 * $param2 ;
                break;
            
            case (array_key_exists('base', $_POST)):   #area del triangolo
                $area = ($param1 * $param2) / 2 ;
                break;
        }

        return $area;
    }

    function perimetro_cerchio($param1) {

        $perimetro = 2 * $param1 * 3.14 ;          

        return $perimetro;
    }

    function perimetro_rettangolo($param1, $param2) {

        $perimetro = 2*$param1 + 2*$param2 ;          

        return $perimetro;
    }

    function perimetro_triangolo($param1, $param2) {

        $ipotenusa = sqrt(pow($param1,2) + pow($param2,2));

        $perimetro = $param1 + $param2 + $ipotenusa;          

        return $perimetro;
    }