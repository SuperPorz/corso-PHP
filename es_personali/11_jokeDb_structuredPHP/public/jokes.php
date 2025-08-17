<?php

    try {
        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/../includes/DatabaseFunctions.php';

        $sql = 'SELECT j.id, joketext, `name`, email
                FROM joke j 
                INNER JOIN author a ON j.authorid = a.id;';
        
        $jokes= $pdo->query($sql);

        $title = 'Joke list';

        $totalJokes = total_jokes($pdo);

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