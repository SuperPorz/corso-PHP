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

        //// FUNZIONI PRIVATE /////
        private function process_dates($fields) {
            foreach($fields as $key => $value) {
                if ($value instanceof DateTime) {
                    $fields[$key] = $value->format('Y-m-d');}
            }
            return $fields;
        }

        private function query($sql, $parameters = []) {
            $query = $this->pdo->prepare($sql);
            $query->execute($parameters);
            return $query;
        }

        ///////// GET, GET_ID, POST, PUT, PATCH, DELETE /////////////

        public function get() {
            $result = $this->query('SELECT * FROM ' . $this->table);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_id($value) {
            $query = 'SELECT * FROM `' . $this->table . '`
                WHERE `' . $this->prim_key . '` = :value';
            $parameters = ['value' => $value];
            $query = $this->query($query, $parameters);
            return $query->fetch(PDO::FETCH_ASSOC);
        }

        public function post($fields) {
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

        public function put($fields) {
            $query = 'REPLACE INTO `' . $this->table . '` (';
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

        public function patch($fields) {
            $query = 'UPDATE `' . $this->table . '` SET ';
            foreach($fields as $key => $value) {
                if ($key !== $this->prim_key) {
                    $query .= '`' . $key . '` = :' . $key . ',';
                }
            }
            $query = rtrim($query, ',');
            $query .= ' WHERE `' . $this->prim_key . '` = :' . $this->prim_key;
            $fields = $this->process_dates($fields);
            $this->query($query, $fields);
        }

        public function delete($id) {
            $parameters = [':id' => $id];
            $this->query('DELETE FROM ' . $this->table . 
                ' WHERE ' . $this->prim_key . ' = :id', $parameters);
        }
    }