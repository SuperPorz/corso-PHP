<?php

    class cAuto {

        private $tab_auto;

        public function __construct(DatabaseTable $tab_auto)
        {
            $this->tab_auto = $tab_auto;
        }

        public function aggiungi_auto(mAuto $auto) {
            $array = [];
            $array['targa'] = $auto->targa;
            $array['proprietario'] = $auto->proprietario;
            $this->tab_auto->save($array);
            return true;
        }

        public function elimina_auto($ida) {
            $this->tab_auto->delete($ida);
            return true;
        }

        public function cerca_auto($ida) {
            return $this->tab_auto->find_by_id($ida);
        }

        public function lista_auto() {
            return $this->tab_auto->find_all();
        }
    }