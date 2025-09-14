<?php

    class GestioneConcerto {

        private $tab_musicista;
        private $tab_utente;
        private $tab_preferenza;

        public function __construct(DatabaseTable $tab_musicista, 
            DatabaseTable $tab_utente, DatabaseTable $tab_preferenza)
        {
            $this->tab_musicista = $tab_musicista;
            $this->tab_utente = $tab_utente;
            $this->tab_preferenza = $tab_preferenza;
        }

        public function registra_musicista($nome, $compenso) 
        {
            $array = [];
            $array['nome'] = $nome;
            $array['compenso'] = $compenso;
            $this->tab_musicista->save($array);
        }

        public function registra_utente($nome, $email, $preferenza) 
        {
            $array1 = [];
            $array1['nome'] = $nome;
            $array1['email'] = $email;
            
            // Salva l'utente per generare un ID
            $this->tab_utente->save($array1);
            
            // Trova l'utente appena inserito per recuperarne l'ID
            $utente_salvato = $this->tab_utente->find_by_field('email', $email);
            
            if ($utente_salvato) {
                $array2 = [];
                // Usa l'ID dell'utente salvato
                $array2['utente_id'] = $utente_salvato[0]['idu']; 
                $array2['musicista_id'] = $preferenza;
                $this->tab_preferenza->save($array2);
            }
        }

        public function elimina_musicista($id) {
            $this->tab_musicista->delete($id);
        }

        public function elimina_utente($id) {
            $this->tab_utente->delete($id);
        }

        private function concerti() {
            $query = 'SELECT m.idm, m.nome, m.compenso, COUNT(*) AS spettatori
                FROM musicista m
                JOIN preferenza p ON m.idm = p.musicista_id
                GROUP BY m.idm
                ORDER BY spettatori DESC';
            $result = $this->tab_utente->query($query);
            return $result->fetchAll();
        }

        public function calcola_costi() {
            $concerti = $this->concerti();

            // Definisci le fasce di prezzo e i relativi costi base
            $fasce_prezzo = [
                'bassa' => ['min_preferenze' => 0, 'max_preferenze' => 100, 'prezzo_base' => 20],
                'media' => ['min_preferenze' => 101, 'max_preferenze' => 500, 'prezzo_base' => 50],
                'alta' => ['min_preferenze' => 501, 'max_preferenze' => PHP_INT_MAX, 'prezzo_base' => 120]
            ];

            foreach($concerti as &$concerto) {  // Aggiunge & per il riferimento
                
                $prezzo_biglietto = 0;
                $spettatori = $concerto['spettatori'];

                // Determina il prezzo del biglietto in base alla fascia di spettatori
                if ($spettatori >= $fasce_prezzo['bassa']['min_preferenze'] 
                    && $spettatori <= $fasce_prezzo['bassa']['max_preferenze']) {
                        $prezzo_biglietto = $fasce_prezzo['bassa']['prezzo_base'];
                } elseif ($spettatori >= $fasce_prezzo['media']['min_preferenze'] 
                    && $spettatori <= $fasce_prezzo['media']['max_preferenze']) {
                        $prezzo_biglietto = $fasce_prezzo['media']['prezzo_base'];
                } elseif ($spettatori >= $fasce_prezzo['alta']['min_preferenze']) {
                    $prezzo_biglietto = $fasce_prezzo['alta']['prezzo_base'];
                }

                $incasso_tot = $spettatori * $prezzo_biglietto;
                $profitto_tot = $incasso_tot - $concerto['compenso'];
                
                $concerto['costo_biglietto'] = $prezzo_biglietto;
                $concerto['incasso_tot'] = $incasso_tot;
                $concerto['profitto_tot'] = $profitto_tot;
            }
            unset($concerto); // Rimuove il riferimento dopo il ciclo
            
            return $concerti;
        }

        public function concerti_profittevoli() {
            $concerti_calcolati = $this->calcola_costi();

            // Ordina l'array per profitto totale (decrescente)
                    usort($concerti_calcolati, function($a, $b) {
                        return $b['profitto_tot'] <=> $a['profitto_tot']; // Ordine decrescente
                    });
            
            // Prende i primi 3 (più profittevoli)
            $top_concerti = array_slice($concerti_calcolati, 0, 3);

            return $top_concerti;
        }

        public function statistiche_database() {
            $query = 'SELECT 
                (SELECT COUNT(*) FROM musicista) AS totale_musicisti,
                (SELECT COUNT(*) FROM utente) AS totale_utenti, 
                (SELECT COUNT(*) FROM preferenza) AS totale_preferenze,
                (SELECT ROUND(AVG(sub.prezzo), 2) FROM 
                    (SELECT (m.compenso * 1.3) / 
                        GREATEST((SELECT COUNT(*) FROM preferenza WHERE musicista_id = m.idm), 1) AS prezzo 
                    FROM musicista m) sub
                ) AS prezzo_medio_biglietto';
            $result = $this->tab_utente->query($query);
            return $result->fetchAll();
        }

        public function statistiche_generali() {
            $query = 'SELECT 
                m.idm,
                m.nome AS musicista,
                m.compenso,
                COUNT(p.idp) AS totale_preferenze,
                ROUND((m.compenso * 1.3) / COUNT(p.idp), 2) AS prezzo_biglietto,
                ROUND(((m.compenso * 1.3) / COUNT(p.idp)) * COUNT(p.idp), 2) AS incasso_totale,
                ROUND(((m.compenso * 1.3) / COUNT(p.idp)) * COUNT(p.idp) - m.compenso, 2) AS profitto_organizzazione
                FROM musicista m
                LEFT JOIN preferenza p ON m.idm = p.musicista_id
                GROUP BY m.idm, m.nome, m.compenso
                ORDER BY profitto_organizzazione DESC';
            $result = $this->tab_utente->query($query);
            return $result->fetchAll();
        }
    }