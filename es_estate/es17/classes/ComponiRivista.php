<?php

    class ComponiRivista extends SelezioneArticoli {

        # ATTRIBUTI SPECIFICI DELLA CLASSE
        private $TOT_PER_PAGINA; //limite battute per pagina (fissata per scelta)
        private $LIMITE_RIVISTA; //limite battute per rivista (fissata dall'esercizio)
        private $num_riviste;
        private $riviste;


        # COSTRUTTORE
        function __construct($num_riviste = 0)
        {
            parent::__construct();
            $this->TOT_PER_PAGINA = 2750;
            $this->LIMITE_RIVISTA = 11000;
            $this->num_riviste = $num_riviste; //unico parametro di istanziazione
            $this->riviste = [];
        }


       # MAIN PROGRAM : COMPOSIZIONE RIVISTA
        private function componi_rivista() {
            // Preparazione contenitori, counters e scorciatoie
            $z = $this->articoli_scelti(); //scorciatoia art. scelti
            $pagine = []; //conterrà le pagine
            $pagina_corrente = []; //conterrà gli articoli di 1 pagina
            $battute_pag = 0; //counter battute pagina corrente
            $battute_tot = 0; //counter battute totali rivista

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


        # MAIN PROGRAM : COMPOSIZIONE RIVISTE PIANIFICATE
        public function componi_riviste_pianificate() {

            for ($idx = 1; $idx <= $this->num_riviste; $idx++) {
                $rivista_singola = $this->componi_rivista();
                $this->riviste[] = $rivista_singola;
                $idx++;                
            }
            return $this->riviste;
        }
    }