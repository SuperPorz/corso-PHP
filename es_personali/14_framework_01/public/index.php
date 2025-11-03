<?php
    // Calcola automaticamente il BASE_URL dal percorso dello script
    $scriptName = dirname($_SERVER['SCRIPT_NAME']);
    define('BASE_URL', $scriptName);
    
    function loadTemplate($templateFileName, $variables = []){
        extract($variables);
        ob_start();
        include  __DIR__ . '/../templates/' . $templateFileName;
        return ob_get_clean();
    }

    try {
        # includes
        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/../classes/DatabaseTable.php';

        # istanze
        $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
        $authorsTable = new DatabaseTable($pdo, 'author', 'id');

        # Pulisci la route rimuovendo il base path
        $requestUri = $_SERVER['REQUEST_URI'];
        $scriptName = dirname($_SERVER['SCRIPT_NAME']);
        
        // Rimuovi il base path dall'URI
        if (strpos($requestUri, $scriptName) === 0) {
            $requestUri = substr($requestUri, strlen($scriptName));
        }
        
        // Rimuovi query string e slash iniziali
        $route = ltrim(strtok($requestUri, '?'), '/');

        if ($route == strtolower($route)) {
            if ($route === 'joke/list') {
                include __DIR__ . '/../controllers/JokeController.php';
                $controller = new JokeController($jokesTable, $authorsTable);
                $page = $controller->list();
            } 
            elseif ($route === '') {
                include __DIR__ . '/../controllers/JokeController.php';
                $controller = new JokeController($jokesTable, $authorsTable);
                $page = $controller->home();
            } 
            elseif ($route === 'joke/edit') {
                include __DIR__ . '/../controllers/JokeController.php';
                $controller = new JokeController($jokesTable, $authorsTable);
                $page = $controller->edit();
            } 
            elseif ($route === 'joke/delete') {
                include __DIR__ . '/../controllers/JokeController.php';
                $controller = new JokeController($jokesTable, $authorsTable);
                $page = $controller->delete();
            } 
            elseif ($route === 'register') {
                include __DIR__ . '/../controllers/RegisterController.php';
                //$controller = new RegisterController($authorsTable);
                $page = $controller->showForm();
            }
            else {
                http_response_code(404);
                $title = '404 - Page Not Found';
                $output = 'The page you requested could not be found.';
            }
        } 
        else {
            http_response_code(301);
            header('location: ' . BASE_URL . '/' . strtolower($route));
            exit();
        }

        if (isset($page)) {
            $title = $page['title'];

            if (isset($page['variables'])) {
                $output = loadTemplate($page['template'], $page['variables']);
            } 
            else {
                $output = loadTemplate($page['template']);
            }
        }
    } 
    catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage() . ' in '
        . $e->getFile() . ':' . $e->getLine();
    }
    
    include  __DIR__ . '/../templates/layout.html.php';
    $pdo = null;