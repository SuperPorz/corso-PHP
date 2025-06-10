<?php

   // $stanza = [$_GET['b']];
   // $piano = $stanza[$_GET['a']];

    $edificio = array(
        0 => array(
            1 => "mario",
            2 => "giovanni",
            3 => "claudia",
            4 => "maria",
            5 => "christine",
        ),

        1 => array(
            1 => "tizio",
            2 => "caio",
            3 => "sempronio",
            4 => "gesualda",
            5 => "genoveffa",
        ),

        2 => array(
            1 => "santiago",
            2 => "clotilde",
            3 => "asdrubale",
            4 => "guidobaldo",
            5 => "martina",
        ),

        3 => array(
            1 => "claudette",
            2 => "sebina",
            3 => "celine",
            4 => "igor",
            5 => array(
                0 => 'marco',
                1 => 'giovanni',
                2 => 'laura',
            ),
        ),
    );

    //metodo 1: definisco nuova variabile a cui assegno la variabile EDIFICIO (array), la quale a sua volta si compone dei due valori GET; dopo printo tale funzione
    $pianoScelto = $edificio[$_GET['piano']][$_GET['stanza']];
    echo '<h1>' . $pianoScelto . '</h1>' . PHP_EOL;

    $pianoScelto2 = $edificio[3][1];                     //richiesta fissa stabilita nel codice
    echo '<h1>' . $pianoScelto2 . '</h1>' . PHP_EOL;

    //metodo 2: definisco 2 variabili nuove, a ognuna assegno un valore GET, poi printo la variabile array EDIFICIO
    $piano = $_GET['piano'];
    $stanza = $_GET['stanza'];

    if (is_array($edificio[$piano][$stanza])) {

        echo '<h1>' . implode(', ', $edificio[$piano][$stanza]) .'</h1>'. PHP_EOL;

    } else {

        echo '<h1>' . $edificio[$piano][$stanza] . '</h1>' . PHP_EOL;
        }
    


    

