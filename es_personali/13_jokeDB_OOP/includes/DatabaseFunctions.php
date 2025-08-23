<?php

    function query($pdo, $sql, $parameters = []) {
        $query = $pdo->prepare($sql);
        $query->execute($parameters);
        return $query;
    }

    function process_dates($fields) {
        foreach($fields as $key => $value) {
            if ($value instanceof DateTime) {
                $fields[$key] = $value->format('Y-m-d');
            }
        }
        return $fields;
    }

    function delete($pdo, $table, $primaryKey, $id) {
        $parameters = [':id' => $id];

        query($pdo, 'DELETE FROM' . $table . '
            WHERE' . $primaryKey . ' = :id', $parameters);
    }

    function insert($pdo, $table, $fields) {
        $query = 'INSERT INTO `' . $table . '` (';

        foreach($fields as $key => $value) {
            $query .= '`' . $key . '`,';
        }

        $query = rtrim($query, ',');
        $query .= ') VALUES (';

        foreach($fields as $key => $value) {
            $query .= ':' . $key . ',';
        }

        $query = rtrim($query, ',');
        $query .= ')';
        $fields = process_dates($fields);

        query($pdo, $table, $fields);
    }

    function update($pdo, $table, $primaryKey, $fields) {
        $query = 'UPDATE `' . $table . '` SET ';

        foreach($fields as $key => $value) {
            $query .= '`' . $key . '` = :' .$key .',';
        }

        $query = rtrim($query, ',');
        $query .= 'WHERE `' . $primaryKey . '` = :primaryKey';

        // Imposta la variabile :primaryKey
        $fields['primaryKey'] = $fields['id'];

        $fields = process_dates($fields);
        query($pdo, $table, $fields);
    }

    function find_by_id($pdo, $table, $primaryKey, $value) {
        $query = 'SELECT * FROM `' . $table . '`
            WHERE `' . $primaryKey . '` = :value';
        
        $parameters = ['value' => $value];
        $query = query($pdo, $table, $parameters);
        return $query->fetch();
    }

    function total($pdo, $table) {
        $query = query($pdo, 'SELECT COUNT(*) 
            FROM `' . $table . '`');
        $row = $query->fetch();
        return $row[0];
    }

    function find_all($pdo, $table) {
        $result = query($pdo, 'SELECT * FROM `' . $table . '`');
        return $result->fetchAll();
    }

    function save($pdo, $table, $primaryKey, $record) {
        try {
            if ($record[$primaryKey] == '') {
                $record[$primaryKey] = null;
            }
            insert($pdo, $table, $record);
        }
        catch (PDOException $e) {
            update($pdo, $table, $primaryKey, $record);
        }
    }