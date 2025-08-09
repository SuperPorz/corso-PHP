<?php

    try {

        $pdo = new PDO('mysql:host=localhost; dbname=libro_01;
            charset=utf8', 'userphp', 'admin');
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT id, joketext FROM joke';
        $jokes= $pdo->query($sql);

        $title = 'Joke list';

        ob_start();

        include __DIR__ . '/../templates/jokes.html.php';

        $output = ob_get_clean();
    }
    catch (PDOException $error) {

        $title = 'An error has occurred';

        $output = 'Database error: ' . $error->getMessage() . 
            ' in ' . $error->getFile() . ':' .$error->getLine();
    }

    include __DIR__ . '/../templates/layout.html.php';

    $pdo = null;