<?php

    class cCliente {

        private $tab_cliente;

        public function __construct(DatabaseTable $tab_cliente)
        {
            $this->tab_cliente = $tab_cliente;
        }

        public function aggiungi_cliente(mCliente $cliente) {
            $array = [
                'nome' => $cliente->nome,
                'mail' => $cliente->mail
            ];
            $this->tab_cliente->save($array);
            return 'aggiunta eseguita con successo!';
        }

        public function elimina_cliente($idc) {
            $this->tab_cliente->delete(intval($idc));
            return 'eliminazione eseguita con successo!';
        }

        public function trova_cliente($idc) {
            return $this->tab_cliente->find_by_id($idc);
        }

    }