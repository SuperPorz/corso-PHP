<?php

    # require: da errore se non trova file; include: non da errore (piu difficile da gestire)
    
    #librerie: 
    require_once( "funz2.php" );
    require_once("output.php");

    #programma principale: 
    $a = 5;
    $b = 3;

    include("config.php");

    scrivi('Somma: ' . somma($a, $b));
    scrivi('Differenza: ' . differenza($a, $b));
    scrivi('Prodotto: ' . prodotto($a, $b));
    scrivi('Divisione: ' . divisione($a, $b));
    