<?php

    class cParcheggio {

        private $tab_parcheggio;

        public function __construct(DatabaseTable $tab_parcheggio)
        {
            $this->tab_parcheggio = $tab_parcheggio;
        }

        public function aggiungi_parcheggio(mParcheggio $parcheggio) {
            $array = [];
            $array['targa'] = $parcheggio->nome;
            $array['tariffa'] = $parcheggio->tariffa;
            $this->tab_parcheggio->save($array);
            return true;
        }

        public function elimina_parcheggio($idp) {
            $this->tab_parcheggio->delete($idp);
            return true;
        }

        public function cerca_parcheggio($idp) {
            return $this->tab_parcheggio->find_by_id($idp);
        }

        public function lista_parcheggio() {
            return $this->tab_parcheggio->find_all();
        }
    }