<?php


try {
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../classes/DatabaseTable.php';

    $jokesTable = new DatabaseTable($pdo, 'joke', 'id');

    if (isset($_POST['joketext'])) { //se form inviato, eseguiamo query aggiornamento

            $joke = $_POST['joke'];
            $joke['jokedate'] = new DateTime();
            $joke['authorid'] = 1;

            $jokesTable->save($joke);
            
            header('location: jokes.php');
        }
        else { //se non inviato, eseguiamo query per richiedere barzelletta non ancora modificata
            if (isset($_GET['id'])){
                $joke = $jokesTable->find_by_id($_GET['id']);
            }
            
            $title = 'Edit joke';
            
            ob_start();
            
            include __DIR__ . '/../templates/editjoke.html.php';
            
            $output = ob_get_clean();
        }
    }
    catch (PDOException $error) {

        $title = 'An error has occurred';
        
        $output = 'Database error: ' . $error->getMessage() . 
            ' in ' . $error->getFile() . ':' .$error->getLine();
    }

    include __DIR__ . '/../templates/layout.html.php';
    
    $pdo = null;

