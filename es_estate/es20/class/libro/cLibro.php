<?php

    class cLibro {

        private $tab_libro;

        public function __construct(DatabaseTable $tab_libro)
        {
            $this->tab_libro = $tab_libro;
        }

        public function aggiungi_biblioteca(mLibro $libro) {
            $array = [
                'titolo' => $libro->titolo,
                'autore' => $libro->autore,
                'genere' => $libro->genere,
                'dewey' => $libro->collocazione
            ];
            $this->tab_libro->save($array);
            return 'aggiunta eseguita con successo!';
        }

        public function elimina_libro($idl) {
            $this->tab_libro->delete(intval($idl));
            return 'eliminazione eseguita con successo!';
        }

        public function trova_libro($idl) {
            return $this->tab_libro->find_by_id($idl);
        }

    }