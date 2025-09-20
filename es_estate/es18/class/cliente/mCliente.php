<?php

    class mCliente {

        public $nome;
        public $mail;

        public function __construct($nome, $mail)
        {
            $this->nome = $nome;
            $this->mail = $mail;
        }
        
    }