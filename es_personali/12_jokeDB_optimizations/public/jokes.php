<?php

    try {
        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/../includes/DatabaseFunctions.php';

        $result = find_all($pdo, 'joke');

        $jokes = [];
        foreach($result as $joke) {
            $author = find_by_id (
                $pdo,
                'author',
                'id',
                $joke['authorid']);

            $joke[] = [
                'id' => $joke['id'],
                'joketext' => $joke['joketext'],
                'name' => $author['name'],
                'email' => $author['email']
            ];
        }

        $title = 'Joke list';

        $totalJokes = total($pdo, 'joke');

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