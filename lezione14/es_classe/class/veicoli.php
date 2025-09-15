<?php

    class Veicoli {

        private $targa;
        private $proprietario;
        private $costruttore;

        public function __construct($targa, $proprietario, $costruttore)
        {
            $this->targa = $targa;
            $this->proprietario = $proprietario;
            $this->costruttore = $costruttore;            
        }

        public function getDati() {
            $array = [];
            $array['targa'] = $this->targa;
            $array['proprietario'] = $this->proprietario;
            $array['costruttore'] = $this->costruttore;
            return $array;
        }

        public function setDati($targa, $proprietario, $costruttore) {
            $this->targa = $targa;
            $this->proprietario = $proprietario;
            $this->costruttore = $costruttore;
        }
    }