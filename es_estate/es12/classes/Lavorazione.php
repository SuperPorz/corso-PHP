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
            $array['costo_h'] = $this->costo;
            $this->tab_lavorazione->save($array);
        }

        public function modifica_lavorazione() {
            $array = [];
            $array['id_lavoraz'] = $_POST['id_lavoraz'];
            $array['descrizione'] = $this->descrizione;
            $array['costo_h'] = $this->costo;
            $this->tab_lavorazione->save($array);
        }

        public function elimina_lavorazione() {
            $id = $_POST['id_lavoraz'];
            $this->tab_lavorazione->delete($id);
        }
    }