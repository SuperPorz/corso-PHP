<?php

    # Mostra il form FINTANTO che non sono ancora dati in input i numeri per il calcolo
    if ($azione_scelta == "MCM" && !isset($_POST["numero1"]) && !isset($_POST["numero2"])) {
        echo '<form action="output.php" method="post" target="_self">'. PHP_EOL;
        echo '<input type="hidden" name="scelta" value="MCM">'. PHP_EOL;
        echo '<h4> Inserire una coppia di numeri, ciascuno compreso tra 1 e 999: </h4>' ;
        echo '<label for="numero1">Numero 1</label>' .PHP_EOL;
        echo '<input type="number" id="numero1" name="numero1" max="999" min="1">' .PHP_EOL;
        echo '<label for="numero2">Numero 2</label>' .PHP_EOL;
        echo '<input type="number" id="numero2" name="numero2" max="999" min="1">' .PHP_EOL;
        echo '<input type="submit" value="Invia">' .PHP_EOL;   
        echo '</form>'. PHP_EOL; 
    } 

    # CALCOLO MCD - ALGORITMO DI EUCLIDE
    function MCD($a, $b) {

        #Fintanto che numero2 è diverso da 0, il ciclo while prosegue
        while ($b != 0) {
            $temp = $b; #assegno b a una var. temporanea
            $b = $a % $b; #b si libera, e gli assegno il resto della divisione di a/b
            $a = $temp; #assegno ad a il valore che aveva in precedenza b, mentre b ha assunto il valore del resto nella precedente riga
        }
        return $a; #ad un certo punto b assumerà valore 0, quindi non si entra nel WHILE, si esegue questa riga di return, che corrisponde proprio al valore di MCD
    }

    # CALCOLO mcm
    function mcm($a, $b) {

        #facciamo return della formula che lega mcm con MCD: mcm = (a*b)/MCD. Osservaz: si dovrebbe usare il modulo di a*b, ma ho gia settato in input solo num. positivi 
        return ($a * $b) / MCD($a, $b);
    }
    

