<?php

    class Operatore {
        private $tab_operatore;
        private $nome;

        public function __construct(DatabaseTable $tab_operatore, $nome) {
            $this->tab_operatore = $tab_operatore;
            $this->nome = $nome;
        }

        public function inserisci_operatore() { 
            $array = [];
            $array['nome'] = $this->nome;
            $this->tab_operatore->save($array);
        }

        public function modifica_operatore($id) {
            $array = [];
            $array['id_operat'] = $id;
            $array['nome'] = $this->nome;
            $this->tab_operatore->save($array);
        }

        public function elimina_operatore($id) {
            $this->tab_operatore->delete($id);
        }
    }