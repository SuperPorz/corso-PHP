<?php

    try {
        # includes
        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/../classes/DatabaseTable.php';
        include __DIR__ . '/../controllers/JokeController.php';

        # istanze
        $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
        $authorsTable = new DatabaseTable($pdo, 'author', 'id');
        $jokeController = new JokeController($jokesTable, $authorsTable);

        # front controller
        $action = $_GET['action'] ?? 'home';
        $page = $jokeController->$action(); //concatenazione di $action + () per chiamare una funzione che varia caso per caso

        # output variables
        $title = $page['title'];
        $output = $page['output'];

    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage() . ' in '
            . $e->getFile() . ':' . $e->getLine();
    }

    include __DIR__ . '/../templates/layout.html.php';
    $pdo = null;