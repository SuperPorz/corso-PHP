<?php

    class cSosta {

        private $tab_sosta;

        public function __construct(DatabaseTable $tab_sosta)
        {
            $this->tab_sosta = $tab_sosta;
        }

        public function inizia_sosta($ida, $idp) {
            $array = [];
            $array = [
                'ida' => $ida,
                'idp' => $idp
            ];
            $this->tab_sosta->save($array);
            return true;
        }

        // QUERY SPECIFICA
        public function termina_sosta($ids) {
            $query = 'UPDATE sosta 
                SET fine_sosta = NOW() 
                WHERE ids = :ids AND fine_sosta IS NULL';
            $parameters = ['ids' => $ids];
            $this->tab_sosta->query($query, $parameters);
            return true;
        }

        public function tutte_soste() {
            return $this->tab_sosta->find_all();
        }

        public function soste_concluse() {
            $soste_concluse = [];
            foreach($this->tutte_soste() as $sosta)
            if ($sosta['fine_fine'] != NULL) {
                $soste_concluse[] = $sosta;
            }
            return $soste_concluse;
        }
    }