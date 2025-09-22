<?php

    class cGestore {

        public $lista_gestori;
        private $tab_gestore;

        public function __construct(DatabaseTable $tab_gestore) {
            $this->tab_gestore = $tab_gestore;
            $this->lista_gestori = [];
        }

        public function aggiungi_gestore(mGestore $gestore) {
            $array = [
                'nome' => $gestore->nome,
                'numero' => $gestore->numero
            ];
            $this->tab_gestore->save($array);
            return 'aggiunta eseguita con successo!';
        }

        public function elimina_gestore($idg) {
            $this->tab_gestore->delete(intval($idg));
            return 'eliminazione eseguita con successo!';
        }

        public function trova_gestore($idg) {
            return $this->tab_gestore->find_by_id($idg);
        }
    }