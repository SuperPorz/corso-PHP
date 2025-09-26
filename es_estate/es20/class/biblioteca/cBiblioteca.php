<?php

    class cBiblioteca {

        private $tab_biblioteca;

        public function __construct(DatabaseTable $tab_biblioteca)
        {
            $this->tab_biblioteca = $tab_biblioteca;
        }
    }