<?php

    use Twig\Environment;

    class vPrenotazione {

        private $tab_prenotazione;

        public function __construct(DatabaseTable $tab_prenotazione)
        {
            $this->tab_prenotazione = $tab_prenotazione;
        }

        public function mostra_lista_prenotazione() {
            return $this->tab_prenotazione->find_all();
        }

        public function mostra_lista_per_data($data, $idg) {
            return $this->tab_prenotazione->prenotazione_per_data($data, $idg);
        }

        public function mostra_lista_per_gestore($idg) {
            return $this->tab_prenotazione->find_by_field('idg', $idg);
        }        
    }