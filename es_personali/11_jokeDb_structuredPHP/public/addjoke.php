<?php

    if (isset($_POST['joketext'])) {

        try {
            include __DIR__ . '/../includes/DatabaseConnection.php';
            include __DIR__ . '/../includes/DatabaseFunction.php';

            insert_joke($pdo, $_POST['joketext'], 1);

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

    $pdo = null;

