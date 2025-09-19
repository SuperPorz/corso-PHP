<?php

    class Sosta {

        private $auto;
        private $parcheggio;
        private $datetime;
        public $lista_soste;

        public function __construct(Auto $auto, Parcheggio $parcheggio)
        {
            $this->auto = $auto;
            $this->parcheggio = $parcheggio;
            $this->datetime = getdate();
            $this->lista_soste = [];
        }

        public function inizia_sosta() {
            $this->lista_soste[] = [
                'auto' => $this->auto->targa,
                'parcheggio' => $this->parcheggio->nome_parcheggio,
                'data' => $this->datetime['mday'] . '/' . $this->datetime['mon'] . '/' . $this->datetime['year'],
                'inizio' => $this->datetime['hours'],
                'fine' => '',
            ];
            return true;
        }

        public function termina_sosta($targa) {

            //calcolo il datetime di fine
            $fine = getdate();
            
            //creo copia lista per ciclare
            $lista_temp = $this->lista_soste;

            //cerco la targa
            foreach($lista_temp as $sosta) {
                if ($sosta['auto']['targa'] == $targa) {

                    //aggiungo la fine sosta al DB
                    $this->lista_soste[$sosta]['fine'] == $fine['hours'];
                }
                else {
                    echo 'sosta sconosciuta';
                }
            }
        }

        public function soste_concluse() {
            $soste_terminate = [];

            foreach($this->lista_soste as $sosta)
            if ($sosta['fine'] != '') {

                $soste_terminate[] = $sosta;
            }
            return $soste_terminate;
        }
    }