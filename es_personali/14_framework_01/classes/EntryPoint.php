<?php
    class EntryPoint {
        private $route;
        private $baseUrl;

        public function __construct($route) {
            // Calcola BASE_URL all'interno della classe
            $this->baseUrl = dirname($_SERVER['SCRIPT_NAME']);
            
            // La route arriva già pulita da index.php
            $this->route = trim($route, '/');
            
            $this->checkUrl();
        }
        
        private function checkUrl() {
            if ($this->route !== strtolower($this->route)) {
                http_response_code(301);
                header('location: ' . $this->baseUrl . '/' . strtolower($this->route));
                exit();
            }
        }

        private function loadTemplate($templateFileName, $variables = []){
            extract($variables);
            ob_start();
            include __DIR__ . '/../templates/' . $templateFileName;
            return ob_get_clean();
        }

        private function callAction() {
            include __DIR__ . '/../includes/DatabaseConnection.php';
            include __DIR__ . '/../classes/DatabaseTable.php';

            $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
            $authorsTable = new DatabaseTable($pdo, 'author', 'id');

            // IMPORTANTE: inizializza $page con un valore di default
            $page = null;

            if ($this->route === 'joke/list') {
                include __DIR__ . '/../controllers/JokeController.php';
                $controller = new JokeController($jokesTable, $authorsTable);
                $page = $controller->list();
            }
            else if ($this->route === '') {
                include __DIR__ . '/../controllers/JokeController.php';
                $controller = new JokeController($jokesTable, $authorsTable);
                $page = $controller->home();
            }
            else if ($this->route === 'joke/edit') {
                include __DIR__ . '/../controllers/JokeController.php';
                $controller = new JokeController($jokesTable, $authorsTable);
                $page = $controller->edit();
            }
            else if ($this->route === 'joke/delete') {
                include __DIR__ . '/../controllers/JokeController.php';
                $controller = new JokeController($jokesTable, $authorsTable);
                $page = $controller->delete();
            }
            else if ($this->route === 'register') {
                include __DIR__ . '/../controllers/RegisterController.php';
                //$controller = new RegisterController($authorsTable);
                $page = $controller->showForm();
            }
            
            // FONDAMENTALE: se nessuna route corrisponde, restituisci 404
            if ($page === null) {
                http_response_code(404);
                $page = [
                    'title' => '404 - Page Not Found',
                    'template' => 'home.html.php',
                    'variables' => []
                ];
            }
            
            return $page;
        }
        
        public function getBaseUrl() {
            return $this->baseUrl;
        }

        public function run() {
            $page = $this->callAction();
            
            // Verifica che $page sia valido
            if (!is_array($page) || !isset($page['title']) || !isset($page['template'])) {
                throw new Exception('Invalid page structure returned from callAction()');
            }
            
            $title = $page['title'];
            
            if (isset($page['variables']) && is_array($page['variables'])) {
                $output = $this->loadTemplate($page['template'], $page['variables']);
            }
            else {
                $output = $this->loadTemplate($page['template']);
            }
            
            include __DIR__ . '/../templates/layout.html.php';
        }
    }