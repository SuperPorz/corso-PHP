<?php

class DatabaseTable {
    private $pdo;
    private $table;
    private $prim_key;

    public function __construct(PDO $pdo, string $table, 
        string $prim_key) {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->prim_key = $prim_key;
    }

    public function query($sql, $parameters = []) {
        $query = $this->pdo->prepare($sql);
        $query->execute($parameters);
        return $query;
    }

    public function find_by_id($value) {
        $query = 'SELECT * FROM `' . $this->table . '`
            WHERE `' . $this->prim_key . '` = :value';
        
        $parameters = ['value' => $value];
        $query = $this->query($query, $parameters);
        return $query->fetch();
    }

    private function insert($fields) {
        $query = 'INSERT INTO `' . $this->table . '` (';

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
        $fields = $this->process_dates($fields);

        $this->query($query, $fields);
    }

    private function update($fields) {
        $query = 'UPDATE `' . $this->table . '` SET ';

        foreach($fields as $key => $value) {
            if ($key !== $this->prim_key) { // Evita di includere la chiave primaria nel SET
                $query .= '`' . $key . '` = :' . $key . ',';
            }
        }

        $query = rtrim($query, ',');
        $query .= ' WHERE `' . $this->prim_key . '` = :prim_key_value';

        // Imposta correttamente la variabile per la condizione WHERE
        $fields['prim_key_value'] = $fields[$this->prim_key];

        $fields = $this->process_dates($fields);
        $this->query($query, $fields);
    }

    public function delete($id) {
        $parameters = [':id' => $id];

        $this->query('DELETE FROM ' . $this->table . 
            ' WHERE ' . $this->prim_key . ' = :id', $parameters);
    }

    public function find_all() {
        $result = $this->query('SELECT * FROM ' . $this->table);
        return $result->fetchAll();
    }

    private function process_dates($fields) {
        foreach($fields as $key => $value) {
            if ($value instanceof DateTime) {
                $fields[$key] = $value->format('Y-m-d');
            }
        }
        return $fields;
    }

    public function save($record) {
        try {
            // Controlla se la chiave primaria esiste E se è vuota o null
            if (!isset($record[$this->prim_key]) || $record[$this->prim_key] == '' || $record[$this->prim_key] === null) {
                // Rimuove la chiave primaria per l'inserimento se è vuota/null
                unset($record[$this->prim_key]);
                $this->insert($record);
            } else {
                // Se la chiave primaria ha un valore, prova l'update
                $this->update($record);
            }
        }
        catch (PDOException $e) {
            // Se l'insert fallisce (per esempio per chiave duplicata), prova l'update
            if (!isset($record[$this->prim_key]) || $record[$this->prim_key] == '' || $record[$this->prim_key] === null) {
                // Se non abbiamo una chiave primaria, non possiamo fare update
                throw $e;
            }
            $this->update($record);
        }
    }

    public function find_by_field($field, $value) {
        $query = 'SELECT * FROM `' . $this->table . 
            '` WHERE `' . $field . '` = :value';
        $parameters = ['value' => $value];
        $result = $this->query($query, $parameters);
        return $result->fetchAll();
    }

    public function conta_records() {
        $query = 'SELECT COUNT(*) FROM ' . $this->table;
        $result = $this->query($query);
        return $result->fetchColumn() ?? 0;
    }

    public function somma_numerica(string $attribute) {
        $query = 'SELECT SUM(' . $attribute . ') FROM ' . $this->table;
        $result = $this->query($query);
        return $result->fetchColumn() ?? 0;
    }
}