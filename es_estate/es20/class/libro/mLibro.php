<?php

    class mLibro {

        public $titolo;
        public $autore;
        public $genere;
        public $dewey;
        public $collocazione;

        public function __construct($titolo, $autore, $genere, $dewey, $collocazione)
        {
            $this->titolo = $titolo;
            $this->autore = $autore;
            $this->genere = $genere;
            $this->dewey = $dewey;
            $this->collocazione = $collocazione;
        }
    }