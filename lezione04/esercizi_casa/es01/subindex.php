<?php

    #REINDIRIZZAMENTO VERSO I FILES DI CALCOLO DI CIASCUNA FIGURA
    $figura = $_POST["figura"];

    if ($figura == "triangolo") {
        echo '<form action="req_triangolo.php" method="post" target="_self">'. PHP_EOL;
        echo '<label for="base">Base</label>' .PHP_EOL;
        echo '<input type="number" id="base" name="base">' .PHP_EOL;
        echo '<label for="altezza">Altezza</label>' .PHP_EOL;
        echo '<input type="number" id="altezza" name="altezza">' .PHP_EOL;
        echo '<input type="submit" value="Invia">' .PHP_EOL;   
        echo '</form>'. PHP_EOL;     
       
    }
    elseif ($figura == 'rettangolo') {
        echo '<form action="req_rettangolo.php" method="post" target="_self">'. PHP_EOL;
        echo '<label for="lato1">Lato 1</label>' .PHP_EOL;
        echo '<input type="number" id="lato1" name="lato1">' .PHP_EOL;
        echo '<label for="lato1">Lato 2</label>' .PHP_EOL;
        echo '<input type="number" id="lato2" name="lato2">' .PHP_EOL;
        echo '<input type="submit" value="Invia">' .PHP_EOL;
        echo '</form>'. PHP_EOL;      
    }
    elseif ($figura == 'cerchio') {
        echo '<form action="req_cerchio.php" method="post" target="_self">'. PHP_EOL;
        echo '<label for="raggio">Raggio</label>' .PHP_EOL;
        echo '<input type="number" id="raggio" name="raggio">' .PHP_EOL;
        echo '<input type="submit" value="Invia">' .PHP_EOL; 
        echo '</form>'. PHP_EOL; 
    };