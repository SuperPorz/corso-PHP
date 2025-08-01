<?php

    try {

        $pdo = new PDO('mysql:host=localhost; dbname=test_libro; 
        charset=utf8', 'userphp', 'admin');
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT joketext FROM joke';
        $result = $pdo->query($sql);
        
        while($row = $result->fetch()) { //fetch: quando non ci sono + risultati, da 'false'
            $jokes[] = $row['joketext'];
        }

        $title = 'Joke list';

        //avvia buffer
        ob_start();

        //includi file ma verrà mantenuto nel buffer del server
        include __DIR__ . '/../templates/jokes.html.php';

        //lettura del buffer e memorizzazione in una variabile
        $output = ob_get_clean();
    }
    catch (PDOException $error) {

        $title = 'An error has occurred';

        $output = 'Database error: ' . $error->getMessage() . 
            ' in ' . $error->getFile() . ':' .$error->getLine();
    }

    include __DIR__ . '/../templates/layout.html.php';

    $pdo = null; //disconnette dal database (per sicurezza)