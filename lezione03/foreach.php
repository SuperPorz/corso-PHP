<?php

    # COSTRUTTO FOR-EACH

    $a = array( 'a'=> 1, 'b' =>2, 'c'=> 3);

    # qui cicliamo gli elementi VALUES che si inseriscono nella variabile $v
    foreach ($a as $v) {
        echo $v . '<br>';
    }

    echo '<br>';

    # qui cicliamo gli elementi KEYS che si inseriscono nella variabile $k
    foreach ($a as $k => $v) {
        echo $k . '<br>';
    }
     echo '<br>';
    # printo KEYS, la freccia e i valori
    foreach ($a as $k => $v) {
        echo $k . ' => ' .$v . '<br>';
    }

    echo '<br>';
