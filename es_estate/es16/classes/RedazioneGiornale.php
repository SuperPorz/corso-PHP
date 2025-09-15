<?php

    class RedazioneGiornale {

        private $tab_articolo;
        private $lista_articoli;
        private $lista_articoli_copy;
        private $articoli_scelti;
        private $autori;
        private $argomenti;
        private $TOT_BATTUTE;
        private $TOT_PER_PAGINA;
        private $LIMITE_RIVISTA;

        public function __construct(DatabaseTable $tab_articolo)
        {
            $this->tab_articolo = $tab_articolo;
            $this->lista_articoli = $this->tab_articolo->find_all();
            $this->lista_articoli_copy = $this->lista_articoli; //creo copia
            $this->articoli_scelti = [];
            $this->autori = [];
            $this->argomenti = [];
            $this->TOT_BATTUTE = 0;
            $this->TOT_PER_PAGINA = 2750;
            $this->TOT_PER_PAGINA = 11000;
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

        # BLOCCHI CODICE
        private function popola_var_classe($articolo) {
            $this->articoli_scelti[] = $articolo;
            $this->autori[] = $articolo['autore'];
            $this->argomenti[] = $articolo['argomento'];
            $this->TOT_BATTUTE += intval($articolo['lunghezza']);

            //tolgo tutti gli articoli dell'autore dalla lista provvisoria
            foreach($this->lista_articoli as $item) {
                if ($item['autore'] == $articolo['autore']) {
                    unset($this->lista_articoli_copy[$articolo]);
                }
            }
        }

        # MAIN PROG
        private function articoli_scelti() {
            while ($this->TOT_BATTUTE <= 11000) {
                $x = $this->lista_articoli_copy; //scorciatoia copia DB
                $y = $this->articoli_scelti; //scorciatoia art. scelti
                $articolo = array_rand($x);

                if (empty($y)) {
                    $this->popola_var_classe($articolo);
                }
                else {
                    //aggiungo articolo se: db !empty & argomento assente, oppure argom presente ma <= 1
                    if ((in_array($articolo['argomento'], $y) && !empty($y)) || 
                        (!in_array($articolo['argomento'], $y) && array_count_values($articolo['argomento'], $y) <= 1)){
                        $this->popola_var_classe($articolo);
                    }
                    elseif (array_count_values($articolo['argomento'], $y) > 1) {
                        foreach($this->lista_articoli as $item) {
                            if ($item['argomento'] == $articolo['argomento']) {
                                unset($this->lista_articoli_copy[$articolo]);
                            }
                        }
                    }
                }
            }
            // ricerca di articolo 'corto' per riempire ultimo spazio
            if ($this->TOT_BATTUTE <= 500) {
                $articolo = array_rand($x);
                foreach($this->lista_articoli as $item) {
                    if ($item['lunghezza'] <= $this->TOT_BATTUTE) {
                        $this->popola_var_classe($articolo);
                    } 
                }   
            }
            return true;
        }

        public function componi_pagine_rivista() {
            // preparazione
            $this->articoli_scelti();
            $z = $this->articoli_scelti; //scorciatoia art. scelti
            $pagine = [];

            while ($this->LIMITE_RIVISTA <= 11000) {
                // composizione pagine
                foreach($z as $articolo) {
                    if ($pagine == []) {
                        $pagine[] = $articolo;
                        $this->TOT_PER_PAGINA -= $articolo['lunghezza'];
                        $this->LIMITE_RIVISTA -= $articolo['lunghezza'];
                    }
                    else {
                        if ($articolo['lunghezza'] <= $this->TOT_PER_PAGINA) {
                            $pagine[] = $articolo;
                            $this->TOT_PER_PAGINA -= $articolo['lunghezza'];
                            $this->LIMITE_RIVISTA -= $articolo['lunghezza'];
                        }
                        else {
                            $this->TOT_PER_PAGINA = 2750; //resetto la variabile
                            break; // esco dal ciclo, una pagina è conclusa
                        }
                    }
                }
            } 
            return $pagine;
        }
    }