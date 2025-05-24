<?php 

    require 'config.php';

    function cicloMCD($a, $b) {
         while ($a % $b  != 0) {
                    #switchare il numero b come numero a per eseguire il successivo step di iterazione della divisione
                    $resto = $a % $b;
                    $a = $b;
                    $b = $resto;
                }
                return $b;
            }

    function MCD($a, $b) {
        if ($a % $b  == 0) {
        } elseif ($a < $b) {
            $temp = $b;
            $b = $a;
            $a = $temp;
            $b = cicloMCD($a, $b); 

        } else {
            $b = cicloMCD($a, $b);
        }
        return $b;
    };

    
    function mcm($a, $b) {
       return ($a * $b) / MCD($a, $b);
    };

 
