<?php

    require 'config.php';

    $coppia_numeri = array(0=> $a, 1=> $b);

    $fattori_primi_A = array();
    $fattori_primi_B = array();

    $dividendi_A = array();
    $dividendi_B = array();


    #PRIMO CICLO WHILE per collezionare tutti i dividendi e i fattori primi di uno del primo numero $a
    $cond1 = True;
    while ($cond1 == True) {

        #divisibilità per 2
        if ($a % 2 == 0) {
            $tempA = $a / 2;
            $dividendi_A[] = $tempA;
            $fattori_primi_A[] = 2;
            $a = $tempA;

        #divisibilità per 3
        } elseif ($a % 3 == 0) {
            $tempA = $a / 3;
            $dividendi_A[] = $tempA;
            $fattori_primi_A[] = 3;
            $a = $tempA;

        #divisibilità per 5
        } elseif ($a % 5 == 0) {
            $tempA = $a / 5;
            $dividendi_A[] = $tempA;
            $fattori_primi_A[] = 5;
            $a = $tempA;
        } else {
            break;
        }

    };

    #SECONDO CICLO WHILE per collezionare tutti i dividendi e i fattori primi di uno del primo numero $b
    $cond2 = True;
    while ($cond2 == True) {

        #divisibilità per 2
        if ($b % 2 == 0) {
            $tempB = $b / 2;
            $dividendi_B[] = $tempB;
            $fattori_primi_B[] = 2;
            $b = $tempB;

        #divisibilità per 3
        } elseif ($b % 3 == 0) {
            $tempB = $b / 3;
            $dividendi_B[] = $tempB;
            $fattori_primi_B[] = 3;
            $b = $tempB;

        #divisibilità per 5
        } elseif ($b % 5 == 0) {
            $tempB = $b / 5;
            $dividendi_B[] = $tempB;
            $fattori_primi_B[] = 5;
            $b = $tempB;
        } else {
            break;
        }

    };

foreach ($fattori_primi_A as $x => $y) {
    echo $y;
};

echo "<br>" .PHP_EOL;

foreach ($fattori_primi_B as $v => $w) {
    echo $w;
};