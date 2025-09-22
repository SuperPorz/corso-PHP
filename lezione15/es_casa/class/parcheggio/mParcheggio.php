<?php

    class mParcheggio {

        public $nome;
        public $tariffa;

        public function __construct($nome, $tariffa)
        {
            $this->nome = $nome;
            $this->tariffa = $tariffa;
        }
    }