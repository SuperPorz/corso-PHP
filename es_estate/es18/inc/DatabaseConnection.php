<?php

    try {
        $pdo = new PDO(
            'mysql:host=localhost; dbname=estate_es18c; charset=utf8',
            'userphp', 
            'admin');
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // echo "Connessione al database riuscita!<br>";
    } catch (PDOException $e) {
        die("Errore di connessione al database: " . $e->getMessage());
    }