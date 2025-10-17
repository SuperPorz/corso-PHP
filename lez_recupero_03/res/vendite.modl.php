<?php

    namespace Model;

    //dato che uso un namespace, devo aggiungere le seguenti:
    use PDO; 
    use PDOException;
    use DateTime;

    class VenditeModel {
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
            
            // Costruisci la parte SET
            foreach($fields as $key => $value) {
                if ($key !== $this->prim_key) {
                    $query .= '`' . $key . '` = :' . $key . ',';
                }
            }
            
            $query = rtrim($query, ',');
            $query .= ' WHERE `' . $this->prim_key . '` = :prim_key';
            
            // Prepara i parametri per la query
            $parameters = [];
            foreach($fields as $key => $value) {
                if ($key !== $this->prim_key) {
                    $parameters[$key] = $value;
                }
            }
            $parameters['prim_key'] = $fields[$this->prim_key];
            
            $parameters = $this->process_dates($parameters);
            $this->query($query, $parameters);
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
                // Controlla se la chiave primaria esiste E se è vuota/null
                if (!isset($record[$this->prim_key]) || $record[$this->prim_key] == '' || $record[$this->prim_key] === null) {
                    // INSERIMENTO - rimuovi completamente la chiave primaria
                    unset($record[$this->prim_key]);
                    $this->insert($record);
                } else {
                    // MODIFICA - mantieni la chiave primaria
                    $this->update($record);
                }
            }
            catch (PDOException $e) {
                // Se l'inserimento fallisce, prova l'update
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

    }