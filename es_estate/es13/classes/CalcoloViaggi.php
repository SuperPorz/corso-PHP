<?php

    class Viaggi {

        private $tab_viaggio;

        public function __construct(DatabaseTable $tab_viaggio) 
        {
            $this->tab_viaggio = $tab_viaggio;
        }

        public function registra_viaggio($partenza, $arrivo, $distanza, $consumo) 
        {
            $array = [];
            $array['luogo_partenza'] = $partenza;
            $array['luogo_arrivo'] = $arrivo;
            $array['distanza'] = $distanza;
            $array['consumo'] = $consumo;
            $this->tab_viaggio->save($array);
        }

        public function elimina_viaggio($id) {
            $this->tab_viaggio->delete($id);
        }

        public function consumo_medio() {
            $lista_viaggi = $this->tab_viaggio->find_all();
            if (empty($lista_viaggi)) {
                return 0;
            }
            else {
                $totale_consumo = 0;
                $numero_viaggi = 0;
                foreach($lista_viaggi as $viaggio) {
                    $totale_consumo += $viaggio['consumo'];
                    $numero_viaggi += 1;
                }
                return $totale_consumo / $numero_viaggi;
            }
        }

        public function viaggi_dispendiosi() {
            $num_viaggi = $this->tab_viaggio->conta_records();
            if ($num_viaggi == 0) {
                return 'nessun viaggio aggiunto';
            }
            else {
                if ($num_viaggi >= 6) {
                    $lista_viaggi = $this->tab_viaggio->find_all();
                    
                    // Ordina l'array per consumo (decrescente)
                    usort($lista_viaggi, function($a, $b) {
                        return $b['consumo'] <=> $a['consumo']; // Ordine decrescente
                    });
                    
                    // Prende i primi 5 (più dispendiosi)
                    return array_slice($lista_viaggi, 0, 5);
                } 
                else {
                    return false;
                }
            }
        }

        public function totale_km() {
            return $this->tab_viaggio->somma_numerica('distanza');
        }
    }