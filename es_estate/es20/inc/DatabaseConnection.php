<?php

    try {
        $pdo = new PDO(
            'mysql:host=localhost; dbname=estate_es20; charset=utf8',
            'userphp', 
            '5TF5$*MSa6!qg2Y');
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // echo "Connessione al database riuscita!<br>";
    } catch (PDOException $e) {
        die("Errore di connessione al database: " . $e->getMessage());
    }