<?php

    class ControllerArticoli {

        private $tab_articolo;

        public function __construct(DatabaseTable $tab_articolo)
        {
            $this->tab_articolo = $tab_articolo;
        }

        # INSERIMENTI/MODIFICHE AL DB
        public function registra_articolo($autore, $titolo, $argomento, $testo, 
            $lunghezza)
        {
            $array = [];
            $array['autore'] = $autore;
            $array['titolo'] = $titolo;
            $array['argomento'] = $argomento;
            $array['testo'] = $testo;
            $array['lunghezza'] = $lunghezza;
            $this->tab_articolo->save($array);
        }

        public function modifica_articolo($array) {
            $this->tab_articolo->save($array);
        }

        public function elimina_articolo($id) {
            $this->tab_articolo->delete($id);
        }
    }