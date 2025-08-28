<?php

    class Lavorazione {
        private $tab_lavorazione;
        private $descrizione;
        private $costo;       

        public function __construct(DatabaseTable $tab_lavorazione, 
            $descrizione, $costo) {
                $this->tab_lavorazione = $tab_lavorazione;
                $this->descrizione = $descrizione;
                $this->costo = $costo;
        }

        public function inserisci_lavorazione() { 
            $array = [];
            $array['descrizione'] = $this->descrizione;
            $array['costo'] = $this->costo;
            $this->tab_lavorazione->save($this->descrizione);
        }

        public function modifica_lavorazione() {
            $array = [];
            $array['id_lavoraz'] = $_POST['id_lavoraz'];
            $array['descrizione'] = $this->descrizione;
            $array['costo'] = $this->costo;
            $this->tab_lavorazione->save($array);
        }

        public function elimina_lavorazione() {
            $id = $_POST['id_lavoraz'];
            $this->tab_lavorazione->delete($id);
        }

        # DA SISTEMARE
        public function tempi_medi() {
            $query = 'SELECT * FROM `tempi_per_operatore` 
                GROUP BY id_lavoraz
                HAVING tempo = AVG(tempo) 
                ORDER BY tempo';
            $result = $this->tab_lavorazione->query($query);
            return $result->fetchAll();
        }

        # DA SISTEMARE
        public function lavorazioni_frequenti() {
            $query = 'SELECT * FROM `tempi_per_operatore` 
                GROUP BY id_lavoraz 
                ORDER BY COUNT(id_lavoraz)';
            $result = $this->tab_lavorazione->query($query);
            return $result->fetchAll();
        }
    }