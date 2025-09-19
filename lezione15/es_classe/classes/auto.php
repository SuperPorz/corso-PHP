<?php

    class Auto {

        public $targa;
        private $proprietario;
        public $lista_auto;

        public function __construct($targa, $proprietario)
        {
            $this->targa = $targa;
            $this->proprietario = $proprietario;
            $this->lista_auto = [];
        }

        public function aggiungi_auto() {
            // controllo che non sia presente già la targa
            $lista_temp = $this->lista_auto;
            foreach($lista_temp as $auto) {
                if ($auto['targa'] == $this->targa) {
                    continue;                    
                }
                else {
                    $this->lista_auto[] = [
                        'targa' => $this->targa,
                        'proprietario' => $this->proprietario
                    ];
                }
            }
            return true;
        }

        public function elimina_auto($targa) {
            $lista_temp = $this->lista_auto;
            foreach($lista_temp as $auto) {
                if ($auto['targa'] == $targa) {
                    unset($this->lista_auto[$auto]);
                }
                else {
                    echo 'targa MAI REGISTRATA';
                }
            }
        }
    }