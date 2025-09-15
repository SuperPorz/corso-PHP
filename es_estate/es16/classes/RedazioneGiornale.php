<?php

    class RedazioneGiornale {

        private $tab_articolo;
        private $lista_articoli;
        private $lista_modifica_autori;
        private $articoli_scelti;
        private $autori;
        private $argomenti;
        private $TOT_BATTUTE;

        public function __construct(DatabaseTable $tab_articolo)
        {
            $this->tab_articolo = $tab_articolo;
            $this->lista_articoli = $this->tab_articolo->find_all();
            $this->lista_modifica_autori = $this->lista_articoli; //creo copia
            $this->articoli_scelti = [];
            $this->autori = [];
            $this->argomenti = [];
            $this->TOT_BATTUTE = 0;
        }

        # INSERIMENTI/MODIFICHE
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

        # BLOCCHI CODICE

        private function conta_articoli() {
            return count($this->lista_modifica_autori); 
        }

        private function random_id() {
            $x = $this->conta_articoli();
            return random_int(1, intval($x));
        }


        # MAIN PROG
        public function proponi_rivista() {

            //ARTICOLI SUCCESSIVI
            while ($this->TOT_BATTUTE <= 11000) {
                // lunghezza tot = 10'000-11'000 battute
                // max 2 articoli per argomento
                // max 1 articolo per autore

                //AGGIUNTA PRIMO ARTICOLO
                //cerco un numero INT tra 1 e max_articoli nel DB
                $rand_id = $this->random_id();
                
                //uso l'int random per cercare il primo articolo
                foreach ($this->lista_articoli as $articolo) {
                    if ($articolo['ida'] === $rand_id) {
                        $primo_articolo = $articolo;
                        break;
                    }
                }

                //tolgo l'autore dalla lista provvisoria modificabile
                foreach($this->lista_articoli as $articolo) {
                    if ($articolo['autore'] == $primo_articolo['autore']) {
                        unset($this->lista_modifica_autori[$articolo]);
                    }
                }

                //aggiungo dati nei rispettivi array contenitori
                $this->articoli_scelti[] = $primo_articolo;
                $this->autori[] = $primo_articolo['autore'];
                $this->argomenti[] = $primo_articolo['argomento'];
                $this->TOT_BATTUTE += intval($primo_articolo['lunghezza']);

                //ARTICOLI SUCCESSIVI
            }
        }
    }