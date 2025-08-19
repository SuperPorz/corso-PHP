<?php

    function query($pdo, $sql, $parameters = []) {
        $query = $pdo->prepare($sql);
        $query->execute($parameters);
        return $query;
    }

    function total_jokes($pdo) {
        $query = query($pdo, 'SELECT COUNT(*) FROM joke');
        $row = $query->fetch();
        return $row[0];
    }

    function get_joke($pdo, $id) {
        $parameters = [':id' => $id];
        $query = query($pdo, 'SELECT * FROM joke 
            WHERE id = :id', $parameters);
        $query->execute();
        return $query->fetch();
    }

    function insert_joke($pdo, $joketext, $authorid) {
        $query = 'INSERT INTO joke (joketext, jokedate, authorid) 
            VALUES (:joketext, CURDATE(), :authorid)';
        
        $parameters = [':joketext' => $joketext,
            '.authorid' => $authorid];

        query($pdo, $query, $parameters);
    }

    function update_joke($pdo, $jokeId, $joketext, $authorid) {
        $parameters = [':joketext' => $joketext, 
            ':authorid' => $authorid, ':id' => $jokeId];
        
        query($pdo, 'UPDATE joke SET authorid = :authorid,
            joketext = :joketext WHERE id = :id', $parameters);
    }

    function delete_joke($pdo, $id) {
        $parameters = [':id' => $id];

        query(
            $pdo, 
            'DELETE FROM joke WHERE id = :id', 
            $parameters);
    }

    function all_jokes($pdo) {
        $jokes = query(
            $pdo, 
            'SELECT j.id, joketext, `name`, email 
            FROM joke j 
            INNER JOIN author a ON j.authorid = a.id');

        return $jokes->fetchAll();
    }