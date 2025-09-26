<?php

    use Twig\Environment;

    class vLibro {

        private $tab_cliente;

        public function __construct(DatabaseTable $tab_cliente)
        {
            $this->tab_cliente = $tab_cliente;
        }

        public function mostra_lista_clienti() {
            return $this->tab_cliente->find_all();
        }

        public function carica_tpl_clienti(Environment $twig) {
            return $twig->load('pages/clienti.twig'); // caricamento template
        }
    }