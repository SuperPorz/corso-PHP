<?php

    class SelezioneArticoli {

        private $tab_articolo;
        public $lista_articoli;
        private $lista_articoli_copy;
        public $articoli_scelti;
        private $autori;
        private $argomenti;
        private $TOT_BATTUTE;

        public function __construct(DatabaseTable $tab_articolo)
        {
            $this->tab_articolo = $tab_articolo;
            $this->lista_articoli = $this->tab_articolo->find_all();
            $this->lista_articoli_copy = $this->lista_articoli; //creo copia
            $this->articoli_scelti = [];
            $this->autori = [];
            $this->argomenti = [];
            $this->TOT_BATTUTE = 0;
        }


        # FUNZIONI PRIVATE (DRY - Dont Repeat Yourself)
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
        // scelgo articoli fino ad arrivare sotto 11k caratteri
        public function articoli_scelti() {
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
            return $this->articoli_scelti;
        }
    }