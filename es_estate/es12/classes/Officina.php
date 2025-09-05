<?php

    class Officina {
        private $tab_intervento;        

        public function __construct(
            DatabaseTable $tab_intervento,
            ) {
            $this->tab_intervento = $tab_intervento;
        }

        # INSERIMENTO/ELIMINAZIONE LAVORAZIONE
        public function inserisci_lavorazione($targa, $lavorazione, $operatore, 
            $tempo, $costo) {
            $array = [];
            $array['targa'] = $targa;
            $array['lavorazione'] = $lavorazione;
            $array['operatore'] = $operatore;
            $array['tempo'] = $tempo;
            $array['costo_h'] = $costo;
            $this->tab_intervento->save($array);
        }
        public function elimina_intervento($id_interv) {
            $this->tab_intervento->delete($id_interv);
        }

        # STORICO GLOBALE OFFICINA
        public function lista_interventi_registrati() {
            return $this->tab_intervento->find_all();
        }

        # STORICO PER TARGA
        public function storico_lavorazioni_targa($targa) {
            return $this->tab_intervento->find_by_field('targa', $targa);
        }

        # COSTO TOTALE PER TARGA
        public function costi_totali($targa) {
            $query = 'SELECT SUM(tempo * costo_h) as spesa_totale   
                FROM intervento
                WHERE targa = :targa';
            $parameters = ['targa' => $targa];
            $result = $this->tab_intervento->query($query, $parameters);
            return $result->fetchAll();
        }

        # [DA SISTEMARE] MIGLIORI OPERATORI
        public function migliori_operatori() {
            $query = 'SELECT operatore, lavorazione, MIN(tempo) as tempo_migliore 
                FROM intervento
                GROUP BY lavorazione';
            $result = $this->tab_intervento->query($query);
            return $result->fetchAll();
        }

        # [DA SISTEMARE] TEMPI MEDI PER LAVORAZIONE
        public function tempi_medi() {
            $query = 'SELECT lavorazione, AVG(tempo) as tempo_medio 
                FROM intervento 
                GROUP BY lavorazione';
            $result = $this->tab_intervento->query($query);
            return $result->fetchAll();
        }

        # DA SISTEMARE
        public function lavorazioni_frequenti() {
            $query = 'SELECT lavorazione, COUNT(*) as frequenza
                FROM intervento 
                GROUP BY lavorazione
                ORDER BY frequenza DESC';
            $result = $this->tab_intervento->query($query);
            return $result->fetchAll();
        }

        # RENDER
        public function render($tpl, $dati) {
            $contenuto = file_get_contents($tpl);
            foreach ($dati as $k => $v) {
                $contenuto = str_replace('{{' . $k . '}}', $v, $contenuto);
            }
            return $contenuto;
        }
    }