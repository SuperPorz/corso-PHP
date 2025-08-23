<?php

    try {
        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/../classes/DatabaseTable.php';

        $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
        $authorTable = new DatabaseTable($pdo, 'author', 'id');

        $result = $jokesTable->find_all();

        $jokes = [];
        foreach($result as $joke) {
            $author = $authorTable->find_by_id($joke['authorid']);

            $joke[] = [
                'id' => $joke['id'],
                'joketext' => $joke['joketext'],
                'jokedate' => $joke['jokedate'],
                'name' => $author['name'],
                'email' => $author['email']
            ];
        }

        $title = 'Joke list';

        $totalJokes = $jokesTable->total();

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