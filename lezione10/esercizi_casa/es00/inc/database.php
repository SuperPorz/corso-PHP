<?php

    $server = "localhost";
    $port = "3306";
    $user = "MIKY";
    $pass = "1990";
    $db = "php_esercizi";

    $conn = mysqli_connect($server, $user, $pass, $db, $port);

    if (!$conn) {
        die("connessione al database fallita: " . mysqli_connect_error());
    } else {
        // var_dump($conn);
    }
