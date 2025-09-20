<?php

    class mPrenotazione {

        public $idg; //id gestore
        public $data;
        public $ora;
        public $idc; //id cliente

        public function __construct($idg, $data, $ora, $idc = NULL)
        {
            $this->idg = $idg;
            $this->data = $data;
            $this->ora = $ora;
            $this->idc = $idc;
        }
    }