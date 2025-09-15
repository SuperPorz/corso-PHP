<?php

    class Auto extends Veicoli {

        public $tipo;

        function __construct($targa, $proprietario, $costruttore)
        {
            parent::__construct($targa, $proprietario, $costruttore);
            $this->tipo = 'AUTO';
        }

        function getDati() {
            $dati_parent = parent::getDati();
            $dati_parent['tipo'] = $this->tipo;
            return $dati_parent;
        }
    }