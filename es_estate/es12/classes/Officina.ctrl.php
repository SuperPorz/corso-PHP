<?php

    class Officina {
        private $tab_lavorazione;
        private $tab_operatore;
        private $targa;
        private $tempo;        

        public function __construct(DatabaseTable $tab_lavorazione,
            DatabaseTable $tab_operatore, $targa, $tempo) {
            $this->tab_lavorazione = $tab_lavorazione;
            $this->tab_operatore = $tab_operatore;
            $this->targa = $targa;
            $this->tempo = $tempo;
        }

    }