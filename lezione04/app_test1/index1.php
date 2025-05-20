<?php

    # require: da errore se non trova file; include: non da errore (piu difficile da gestire)
    
    #librerie: 
    require_once( "funz1.php" );

    #programma principale: 
    $a = 5;
    $b = 3;

    echo 'Somma: ' . somma($a, $b) . '<br>';
    echo 'Differenza: ' . differenza($a, $b) . '<br>';
    echo 'Prodotto: ' . prodotto($a, $b) . '<br>';
    echo 'Divisione: ' . divisione($a, $b) . '<br>';