<?php

    class BasketStats {

        private $tab_giocatore;

        public function __construct(DatabaseTable $tab_giocatore)
        {
            $this->tab_giocatore = $tab_giocatore;
        }

        public function registra_giocatore($nome, $ruolo, $punti, $rimbalzi, $assist, 
            $resistenza, $palle_perse, $falli)
        {
            $array = [];
            $array['nome'] = $nome;
            $array['ruolo'] = $ruolo;
            $array['punti'] = $punti;
            $array['rimbalzi'] = $rimbalzi;
            $array['assist'] = $assist;
            $array['resistenza'] = $resistenza;
            $array['palle_perse'] = $palle_perse;
            $array['falli'] = $falli;
            $this->tab_giocatore->save($array);
        }

        public function elimina_giocatore($id) {
            $this->tab_giocatore->delete($id);
        }

        public function main_program() {
            # leggo tutti i giocatori dal Db
            $giocatori = $this->tab_giocatore->find_all();

            # preparo le variabili array per ciascun ruolo
            $playmaker = [];
            $guardia = [];
            $ala_piccola = [];
            $ala_grande = [];
            $pivot = [];

            # aggiungo ogni giocatore nella variabile adeguata
            foreach($giocatori as $giocatore) {
                if ($giocatore['ruolo'] == 'playmaker') {
                    $playmaker[] = $giocatore;
                }
                elseif ($giocatore['ruolo'] == 'guardia') {
                    $guardia[] = $giocatore;
                }
                elseif ($giocatore['ruolo'] == 'ala_piccola') {
                    $ala_piccola[] = $giocatore;
                }
                elseif ($giocatore['ruolo'] == 'ala_grande') {
                    $ala_grande[] = $giocatore;
                }
                elseif ($giocatore['ruolo'] == 'pivot') {
                    $pivot[] = $giocatore;
                }
            }

            # aggiungo le variabili dei ruoli ad un array per compattare
            # il codice di calcolo dei migliori di ogni ruolo
            $ruoli = [];
            $ruoli_validi = ['playmaker' => $playmaker, 'guardia' => $guardia, 'ala_piccola' => $ala_piccola, 'ala_grande' => $ala_grande, 'pivot' => $pivot];

            # ciclo sul nuovo contenitore generale per estrapolare il top e 
            # preparo la top 5, preparo anche i sostituti:
            $top5 = [];
            $sostituzioni = [];
            foreach($ruoli_validi as $ruolo_nome => $giocatori_per_ruolo) {
                
                // Ordina l'array per ranking (decrescente)
                usort($giocatori_per_ruolo, function($a, $b) {
                    return $b['ranking'] <=> $a['ranking'];
                });

                // Se l'array per il ruolo non è vuoto, prendi il miglior giocatore
                if (count($giocatori_per_ruolo) > 0) {
                    $migliore = $giocatori_per_ruolo[0];
                    $top5[] = $migliore;

                    // Se il miglior giocatore ha resistenza <= 25 e c'è un sostituto
                    if ($migliore['resistenza'] <= 25 && count($giocatori_per_ruolo) > 1) {
                        $sostituto = $giocatori_per_ruolo[1];
                        $sostituzioni[$migliore['nome']] = $sostituto['nome'];
                    }
                }
            }

            # costruisco array dei risultati
            $risultati = [];
            array_push($risultati, $ruoli_validi, $top5, $sostituzioni);

            # return dei risultati
            return $risultati;
        }
    }