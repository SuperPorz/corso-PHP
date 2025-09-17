<?php

    class ComponiRivista extends SelezioneArticoli {

        # ATTRIBUTI SPECIFICI DELLA CLASSE
        private $TOT_PER_PAGINA;
        private $LIMITE_RIVISTA;
        private $riviste;

        # COSTRUTTORE
        function __construct($tabella_DB)
        {
            parent::__construct($tabella_DB);
            $this->TOT_PER_PAGINA = 2750;
            $this->LIMITE_RIVISTA = 11000;
            $this->riviste = [];
        }

        # COMPOSIZIONE RIVISTA
        private function componi_rivista() {
            // Reset degli articoli scelti per ogni nuova rivista
            $this->resetSelezione();
            
            // Preparazione contenitori, counters e scorciatoie
            $z = $this->articoli_scelti();
            $pagine = [];
            $pagina_corrente = [];
            $battute_pag = 0;
            $battute_tot = 0;

            foreach($z as $articolo) {
                // Se l'articolo entra nella pagina corrente: aggiungi art.
                if ($battute_pag + $articolo['lunghezza'] <= $this->TOT_PER_PAGINA && 
                    $battute_tot + $articolo['lunghezza'] <= $this->LIMITE_RIVISTA) {
                    
                    $pagina_corrente[] = $articolo;
                    $battute_pag += $articolo['lunghezza'];
                    $battute_tot += $articolo['lunghezza'];
                } else {
                    // Pagina piena, inizia una nuova pagina
                    if (!empty($pagina_corrente)) {
                        $pagine[] = $pagina_corrente;
                    }
                    
                    // Controlla se abbiamo raggiunto il limite della rivista
                    if ($battute_tot + $articolo['lunghezza'] > $this->LIMITE_RIVISTA) {
                        break;
                    }
                    
                    // Inizia nuova pagina
                    $pagina_corrente = [$articolo];
                    $battute_pag = $articolo['lunghezza'];
                    $battute_tot += $articolo['lunghezza'];
                }
            }
            
            // Aggiungi l'ultima pagina se non è vuota
            if (!empty($pagina_corrente)) {
                $pagine[] = $pagina_corrente;
            }
            return $pagine;
        }

        # COMPOSIZIONE RIVISTE PIANIFICATE
        public function componi_riviste($num_riviste) {
            $this->riviste = [];
            
            for ($idx = 1; $idx <= intval($num_riviste); $idx++) {
                $rivista_singola = $this->componi_rivista();
                $this->riviste[] = $rivista_singola;
            }
            return $this->riviste;
        }

        # DB TEMPORANEO SU FILE
        public function lettura() {
            if (!file_exists('temp/riviste.db')) {
                return [];
            } 
            else {
                return unserialize(file_get_contents('temp/riviste.db'));
            }
        }

        public function scrittura($array) {
            // Crea la directory se non esiste
            if (!is_dir('temp')) {
                mkdir('temp', 0777, true);
            }
            
            $x = fopen('temp/riviste.db', 'w+');
            if ($x == true) {
                fwrite($x, serialize($array));
                fclose($x);
                return true;
            } 
            else {
                return false;
            }
        }

        public function elimina_temp_db() {
            if (file_exists('temp/riviste.db')) {
                unlink('temp/riviste.db');
            }
        }
    }