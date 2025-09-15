<?php

    class Camion extends Veicoli {

        public $tipo;

        function __construct($targa, $proprietario, $costruttore)
        {
            parent::__construct($targa, $proprietario, $costruttore);
            $this->tipo = 'CAMION';
        }

        function getDati() {
            $dati_parent = parent::getDati();
            $dati_parent['tipo'] = $this->tipo;
            return $dati_parent;
        }
    }