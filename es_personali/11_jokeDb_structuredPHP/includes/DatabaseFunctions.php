<?php

    function query($pdo, $sql, $parameters = []) {
        $query = $pdo->prepare($sql);
        $query->exectute($parameters);
        return $query;
    }

    function total_jokes($pdo) {
        $query = query($pdo, 'SELECT COUNT(*) FROM joke');
        $row = $query->fetch();
        return $row[0];
    }

    function get_joke($pdo, $id) {
        $parameters = [':id' => $id];
        $query = query($pdo, 'SELECT FROM joke WHERE id = :id', $parameters);
        $query->execute();
        return $query->fetch();
    }