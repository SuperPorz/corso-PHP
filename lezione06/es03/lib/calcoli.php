<?php

    function area($param1, $param2) {

        switch (True) {
            case ($param2 == 0):  #caso del cerchio
                $area = $param1**2 * 3.14 ;
                break;

            case isset($param2):
                $area = $param1 * $param2 ;
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