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
                if ($key !== $this->prim_key) {
                    $query .= '`' . $key . '` = :' .$key .',';
                }
            }
    
            $query = rtrim($query, ',');
            $query .= ' WHERE `' . $this->prim_key . '` = :prim_key';
    
            $fields['prim_key'] = $fields[$this->prim_key];
    
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
                // Controlla se la chiave primaria esiste E se è vuota
                if (!isset($record[$this->prim_key]) || $record[$this->prim_key] == '') {
                    $record[$this->prim_key] = null;
                }
                $this->insert($record);
            }
            catch (PDOException $e) {
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

        //QUERY SPECIALI
        public function prenotazione_per_data($data, $idg) {
            $query = 'SELECT * FROM `' . $this->table . 
                '` WHERE `data` = :data AND `idg` = :idg';
            $parameters = [
                'data' => $data,
                'idg' => $idg
            ];
            $result = $this->query($query, $parameters);
            return $result->fetchAll();
        }

        // Metodo per query personalizzate con multiple condizioni
        public function find_by_multiple_fields($conditions = [], $parameters = []) {
            $query = 'SELECT * FROM `' . $this->table . '`';
            
            if (!empty($conditions)) {
                $query .= ' WHERE ';
                $where_conditions = [];
                
                foreach ($conditions as $field => $value) {
                    $where_conditions[] = '`' . $field . '` = :' . $field;
                    $parameters[$field] = $value;
                }
                
                $query .= implode(' AND ', $where_conditions);
            }
            
            $result = $this->query($query, $parameters);
            return $result->fetchAll();
        }

    }