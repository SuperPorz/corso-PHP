<?php

    try {
        $pdo = new PDO(
            'mysql:host=localhost; dbname=estate_es12_officina; charset=utf8', 
            'userphp', 
            'admin');
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Aggiungi questo per verificare la connessione
        echo "Connessione al database riuscita!<br>";
    } catch (PDOException $e) {
        die("Errore di connessione al database: " . $e->getMessage());
    }