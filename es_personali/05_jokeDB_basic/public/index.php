<?php

    try {

        $pdo = new PDO('mysql:host=localhost; dbname=test_libro; 
        charset=utf8', 'userphp', 'admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql1 = 'UPDATE joke SET jokedate="2012-04-01" WHERE joketext LIKE "%programmer%"';
        $affectedRows = $pdo->exec($sql1);
        $output = 'Updated ' . $affectedRows .' rows.';

        $sql2 = 'SELECT joketext FROM joke';
        $result = $pdo->query($sql2);
        while($row = $result->fetch()) { //fetch fa parte dell'oggetto PDOstatement (quando non ci sono + risultati, da 'false')
            $jokes[] = $row['joketext'];
        }
    }
    catch (PDOException $error) {
        $output = 'Unable to connect to the database server.' . $error; // $error conterrà un oggetto, un'eccezione PDO
        $error->getMessage() . ' in ' . $error->getFile() . ':' .$error->getLine(); //utile per avere piu informazioni sugli errori
    }

    include __DIR__ . '/../templates/jokes.html.php';

    $pdo = null; //disconnette dal database (per sicurezza)