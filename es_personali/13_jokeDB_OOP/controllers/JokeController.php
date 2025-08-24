<?php

    class JokeController {
        private $authorsTable;
        private $jokesTable;

        public function __construct(DatabaseTable $jokesTable,
            DatabaseTable $authorsTable) {
                $this->jokesTable = $jokesTable;
                $this->authorsTable = $authorsTable;            
        }

        public function home() {
            $title = 'Internet Joke Database';
            return ['template' => 'home.html.php', 'title' => $title];
        }

        public function list() {
            $result = $this->jokesTable->find_all();

            $jokes = [];
            foreach ($result as $joke) {
                $author = 
                $this->authorsTable->find_by_id($joke['authorid']);

                $jokes[] = [
                    'id' => $joke['id'],
                    'joketext' => $joke['joketext'],
                    'jokedate' => $joke['jokedate'],
                    'name' => $author['name'],
                    'email' => $author['email']
                ];
            }

            $title = 'Joke list';
            $totalJokes = $this->jokesTable->total();
            ob_start();
            include __DIR__ . '/../templates/jokes.html.php';
            $output = ob_get_clean();
            return [
                'title' => $title,
                'variables' => [
                    'totalJokes' => $totalJokes,
                    'jokes' => $jokes
                ]
            ];
        }

        public function delete() {
            $this->jokesTable->delete($_POST['id']);
            header('location: index.php?action=list');
        }

        public function edit() {
            if (isset($_POST['joke'])) {
                $joke = $_POST['joke'];
                $joke['jokedate'] = new DateTime();
                $joke['authorid'] = 1;
                $this->jokesTable->save($joke);
                header('location: index.php?action=list');
            }
            else {
                if (isset($_GET['id'])) {
                    $joke = $this->jokesTable->find_by_id($_GET['id']);
                }
                $title = 'Edit joke';
                ob_start();
                include __DIR__ . '/../templates/home.html.php';
                $output = ob_get_clean();
                return [
                    'title' => $title,
                    'variables' => [
                        'totalJokes' => $totalJokes,
                        'jokes' => $jokes ?? null
                    ]
                ];
            }
        }
        
    }