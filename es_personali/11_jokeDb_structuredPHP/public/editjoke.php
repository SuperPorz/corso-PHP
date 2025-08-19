<?php

    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../includes/DatabaseFunctions.php';

    try {
        if (isset($_POST['joketext'])) { //se form inviato, eseguiamo query aggiornamento

            update_joke($pdo, $_POST['jokeid'], $_POST['joketext'], 1);
            
            header('location: jokes.php');
        }
        else { //se non inviato, eseguiamo query per richiedere barzelletta non ancora modificata
            $joke = get_joke($pdo, $_GET['id']);
            
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

