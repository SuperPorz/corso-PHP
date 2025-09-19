<?php

    class Parcheggio {

        public $nome_parcheggio;
        private $tariffa;
        public $lista_parcheggi;
        public $soste_pagate;

        public function __construct($nome_parcheggio, $tariffa)
        {
            $this->nome_parcheggio = $nome_parcheggio;
            $this->tariffa = $tariffa;
            $this->lista_parcheggi = [];
            $this->soste_pagate = [];
        }

        // calcola le tariffe di tutte le soste concluse di uno specifico parcheggio
        public function calcola_tariffa(Sosta $db_soste) {

            $lista_soste = $db_soste->soste_concluse(); //copio le soste concluse dall'altra classe

            foreach($lista_soste as $sosta) {
                if ($sosta['parcheggio'] == $this->nome_parcheggio) {

                    //calcolo la tariffa
                    $a = $sosta['inizio'];
                    $b = $sosta['fine'];
                    $interval = $a->diff($b);
                    $costo_tot = $interval * $this->tariffa;

                    //aggiungo la sosta lista soste pagate
                    $this->soste_pagate[] = $sosta;

                    //aggiungo la coppia []'costo_tot' => __€]
                    $this->soste_pagate[$sosta]['costo-tot'] = $costo_tot . ' €';
                }
                return $this->soste_pagate;
            }
        }        
    }