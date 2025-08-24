<?php

    function load_template($templateFileName, $variables = []) {
        extract($variables);
        ob_start();
        include __DIR__ . '/../templates/' . $templateFileName;
        return ob_get_clean();
    }

    try {
        # includes
        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/../classes/DatabaseTable.php';
        include __DIR__ . '/../controllers/JokeController.php';

        # istanze
        $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
        $authorsTable = new DatabaseTable($pdo, 'author', 'id');
        $jokeController = new JokeController($jokesTable, $authorsTable);

        # caricamento template corretto ed estrazione variabili
        $action = $_GET['action'] ?? 'home';
        $page = $jokeController->$action();
        $title = $page['title'];

        if (isset($page['variables'])) {
            $output = load_template($page['template'], $page['variables']);
        }
        else {
            $output = load_template($page['template']);
        }

    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage() . ' in '
            . $e->getFile() . ':' . $e->getLine();
    }

    include __DIR__ . '/../templates/layout.html.php';
    $pdo = null;