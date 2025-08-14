<?php

    if (isset($_POST['joketext'])) {

        try {
            $pdo = new PDO('mysql:host=localhost; dbname=libro_01; 
            charset=utf8', 'userphp', 'admin');
            
            $pdo->setAttribute(PDO::ATTR_ERRMODE, 
            PDO::ERRMODE_EXCEPTION);

            $sql = 'INSERT INTO joke SET joketext = :joketext, 
                jokedate = CURDATE()'; 
            
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':joketext', $_POST['joketext']);
            $statement->execute();

            # inseriamo nella risposta al client, un reindirizzamento
            header('location: jokes.php');
        }
        catch (PDOException $error) {
    
            $title = 'An error has occurred';
    
            $output = 'Database error: ' . $error->getMessage() . 
                ' in ' . $error->getFile() . ':' .$error->getLine();
        }
    }
    else {
        $title = 'Add a new joke';

        ob_start();

        include __DIR__ . '/../templates/addjoke.html.php';

        $output = ob_get_clean();
    }

    include __DIR__ . '/../templates/layout.html.php';

    $pdo = null; //disconnette dal database (per sicurezza)

