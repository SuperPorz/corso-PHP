<?php

    try {

        $pdo = new PDO('mysql:host=localhost; dbname=test_libro; 
        charset=utf8', 'userphp', 'admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT joketext FROM joke';
        $result = $pdo->query($sql);
        
        while($row = $result->fetch()) { //fetch fa parte dell'oggetto PDOstatement (quando non ci sono + risultati, da 'false')
            $jokes[] = $row['joketext'];
        }

        $title = 'Joke list';

        $output = '';

        foreach($jokes as $joke) {
            $output .= '<blockquote><p>';
            $output .= $joke;
            $output .= '</blockquote></p>';
        }
    }
    catch (PDOException $error) {

        $title = 'An error has occurred';

        $output = 'UDatabase error: ' . $error->getMessage() . 
            ' in ' . $error->getFile() . ':' .$error->getLine(); //utile per avere piu informazioni sugli errori
    }

    include __DIR__ . '/../templates/layout.html.php';

    $pdo = null; //disconnette dal database (per sicurezza)