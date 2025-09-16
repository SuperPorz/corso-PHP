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
            $this->LIMITE_RIVISTA = 11000; // Corretto: era assegnato due volte
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

            // Rimuovo tutti gli articoli dell'autore dalla lista provvisoria
            foreach($this->lista_articoli_copy as $key => $item) {
                if ($item['autore'] == $articolo['autore']) {
                    unset($this->lista_articoli_copy[$key]); // Uso la chiave corretta
                }
            }
        }

        # MAIN PROG
        private function articoli_scelti() {
            while ($this->TOT_BATTUTE <= 11000) {
                $x = $this->lista_articoli_copy; //scorciatoia copia DB
                $y = $this->articoli_scelti; //scorciatoia art. scelti
                
                // Controllo se ci sono ancora articoli disponibili
                if (empty($x)) {
                    break;
                }
                
                $articolo = $x[array_rand($x)];

                if (empty($y)) {
                    $this->popola_var_classe($articolo);
                }
                else {
                    // Corretto: controllo argomenti negli articoli già scelti
                    $argomenti_presenti = array_column($this->articoli_scelti, 'argomento');
                    $count_argomento = array_count_values($argomenti_presenti);
                    
                    // Aggiungo articolo se: argomento non presente, oppure presente ma <= 1 volta
                    if (!isset($count_argomento[$articolo['argomento']]) || 
                        $count_argomento[$articolo['argomento']] <= 1) {
                        $this->popola_var_classe($articolo);
                    }
                    else {
                        // Rimuovo tutti gli articoli con questo argomento dalla lista
                        foreach($this->lista_articoli_copy as $key => $item) {
                            if ($item['argomento'] == $articolo['argomento']) {
                                unset($this->lista_articoli_copy[$key]);
                            }
                        }
                    }
                }
            }
            
            // Ricerca di articolo 'corto' per riempire ultimo spazio
            $spazio_rimanente = 11000 - $this->TOT_BATTUTE;
            if ($spazio_rimanente > 0 && $spazio_rimanente <= 500) {
                foreach($this->lista_articoli_copy as $item) {
                    if ($item['lunghezza'] <= $spazio_rimanente) {
                        $this->popola_var_classe($item);
                        break; // Prendo solo il primo che trova
                    } 
                }   
            }
            return true;
        }

        public function componi_pagine_rivista() {
            // Preparazione
            $this->articoli_scelti();
            $z = $this->articoli_scelti; //scorciatoia art. scelti
            $pagine = [];
            $pagina_corrente = [];
            $battute_pagina_corrente = 0;
            $battute_totali_usate = 0;

            foreach($z as $articolo) {
                // Se l'articolo entra nella pagina corrente
                if ($battute_pagina_corrente + $articolo['lunghezza'] <= $this->TOT_PER_PAGINA && 
                    $battute_totali_usate + $articolo['lunghezza'] <= $this->LIMITE_RIVISTA) {
                    
                    $pagina_corrente[] = $articolo;
                    $battute_pagina_corrente += $articolo['lunghezza'];
                    $battute_totali_usate += $articolo['lunghezza'];
                } else {
                    // Pagina piena, inizia una nuova pagina
                    if (!empty($pagina_corrente)) {
                        $pagine[] = $pagina_corrente;
                    }
                    
                    // Controlla se abbiamo raggiunto il limite della rivista
                    if ($battute_totali_usate + $articolo['lunghezza'] > $this->LIMITE_RIVISTA) {
                        break;
                    }
                    
                    // Inizia nuova pagina
                    $pagina_corrente = [$articolo];
                    $battute_pagina_corrente = $articolo['lunghezza'];
                    $battute_totali_usate += $articolo['lunghezza'];
                }
            }
            
            // Aggiungi l'ultima pagina se non è vuota
            if (!empty($pagina_corrente)) {
                $pagine[] = $pagina_corrente;
            }
            
            return $pagine;
        }
    }