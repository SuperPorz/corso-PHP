<?php

    class Officina {
        private $tab_tempi_operatore;
        private $tab_intervento;        

        public function __construct(
            DatabaseTable $tab_tempi_operatore,
            DatabaseTable $tab_intervento,
            ) {
            $this->tab_tempi_operatore = $tab_tempi_operatore;
            $this->tab_intervento = $tab_intervento;
        }

        public function richiesta_lavorazione($targa, $lavorazione, $operatore) {
            $array = [];
            $array['targa'] = $targa;
            $array['id_lavoraz'] = $lavorazione;
            $array['id_operat'] = $operatore;
            $this->tab_intervento->save($array);
        }
        
        public function tempi_per_operatore($lavorazione, $operatore, $tempo) {
            $array = [];
            $array['id_operat'] = $operatore;
            $array['id_lavoraz'] = $lavorazione;
            $array['tempo'] = $tempo;
            $this->tab_tempi_operatore->save($array);
        }

        public function storico_lavorazioni($targa) {
            return $this->tab_intervento->find_by_field('targa', $targa);
        }

        public function costi_totali($targa) {
            $query = 'SELECT targa, SUM(tempo * costo_h) as spesa_totale   
                FROM intervento i
                JOIN lavorazione l ON i.id_lavoraz = l.id_lavoraz
                JOIN operatore o ON i.id_operat = o.id_operat
                JOIN tempi_per_operatore t ON i.id_operat = t.id_operat
                GROUP BY targa
                HAVING targa = :targa';
            $parameters = ['targa' => $targa];
            $result = $this->tab_intervento->query($query, $parameters);
            return $result->fetchAll();
        }

        public function elimina_tempi_operatore($id_tempi) {
            $this->tab_tempi_operatore->delete($id_tempi);
        }

        public function elimina_intervento($id_interv) {
            $this->tab_intervento->delete($id_interv);
        }

        # DA SISTEMARE
        public function migliori_operatori() {
            $query = 'SELECT * FROM `tempi_per_operatore` 
                GROUP BY id_lavoraz
                HAVING tempo = MIN(tempo) 
                ORDER BY tempo';
            $result = $this->tab_intervento->query($query);
            return $result->fetchAll();
        }

        # DA SISTEMARE
        public function tempi_medi() {
            $query = 'SELECT * FROM `tempi_per_operatore` 
                GROUP BY id_lavoraz
                HAVING tempo = AVG(tempo) 
                ORDER BY tempo';
            $result = $this->tab_intervento->query($query);
            return $result->fetchAll();
        }

        # DA SISTEMARE
        public function lavorazioni_frequenti() {
            $query = 'SELECT * FROM `tempi_per_operatore` 
                GROUP BY id_lavoraz 
                ORDER BY COUNT(id_lavoraz)';
            $result = $this->tab_intervento->query($query);
            return $result->fetchAll();
        }
    }