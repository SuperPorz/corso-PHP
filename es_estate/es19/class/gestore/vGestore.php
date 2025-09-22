<?php

    use Twig\Environment;

    class vGestore {

        private $tab_gestore;

        public function __construct(DatabaseTable $tab_gestore)
        {
            $this->tab_gestore = $tab_gestore;
        }

        public function mostra_lista_gestori() {
            return $this->tab_gestore->find_all();
        }

        public function carica_tpl_gestori(Environment $twig) {
            return $twig->load('pages/gestori.twig'); // caricamento template
        }
    }