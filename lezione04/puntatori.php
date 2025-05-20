<?php

    function somma($a, $b, &$s) {
        $s = $a + $b;
    }

    $cippolippo = 0;
    somma(2, 3, $cippolippo);
    echo 'Somma ' . $cippolippo ."<br>";
