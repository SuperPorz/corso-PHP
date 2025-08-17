<?php

    //include il file che crea la variabile $pdo e si connette al db
    include_once __DIR__ . 
        '/../includes/DatabaseConnection.php';

    //include il file che fornisce la funzione total_jokes
    include_once __DIR__ . 
        '/../includes/DatabaseFunctions.php';

    //richiama la funzione total_jokes
    echo total_jokes($pdo);