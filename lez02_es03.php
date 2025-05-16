<?php

    $cateto1 = $_GET['a'];
    $cateto2 = $_GET['b'];
    $ipotenusa = $_GET['c'];

    $area = ($cateto1 + $cateto2) /2;
    $perimetro = $cateto1 + $cateto2 + $ipotenusa;
    echo '<h2>' . 'cateto a: ' . $cateto1 . '</h2>';
    echo '<h2>' . ' cateto b: ' . $cateto2 . '</h2>';
    echo '<h2>' . ' ipotenusa c: ' . $ipotenusa . '</h2>';
    echo '<h1>' . ' Area: ' . $area . '</h1>';
    echo '<h1>' . ' Perimetro: ' . $perimetro . '</h1>';
