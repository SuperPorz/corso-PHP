<?php

    try {
        include __DIR__ . '/../includes/DatabaseConnection.php';

        $sql = 'DELETE FROM joke WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $_POST['id']);
        $stmt->execute();

        header('location: jokes.php');
    }
    catch (PDOException $error) {

        $title = 'An error has occurred';

        $output = 'Database error: ' . $error->getMessage() . 
            ' in ' . $error->getFile() . ':' .$error->getLine();
    }

    include __DIR__ . '/../templates/layout.html.php';

    $pdo = null;