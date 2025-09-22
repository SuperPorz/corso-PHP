<?php

    class cPrenotazione {

        public $lista_prenotazioni;
        private $tab_prenotazione;
        private $tab_gestore;
        private $tab_cliente;

        public function __construct(DatabaseTable $tab_prenotazione, 
            DatabaseTable $tab_gestore, DatabaseTable $tab_cliente) {
                $this->tab_prenotazione = $tab_prenotazione;
                $this->tab_gestore = $tab_gestore;
                $this->tab_cliente = $tab_cliente;
                $this->lista_prenotazioni = [];
        }

        // aggiunge prenotazione/disponibilità
        public function aggiungi_prenotazione(mprenotazione $prenotazione) {
            $array = [
                'idg' => $prenotazione->idg,
                'data' => $prenotazione->data,
                'ora' => $prenotazione->ora,
                'idc' => $prenotazione->idc  // può essere NULL per disponibilità
            ];
            $this->tab_prenotazione->save($array);
            return 'aggiunta eseguita con successo!';
        }

        // elimina prenotazione
        public function elimina_prenotazione($idp) {
            $this->tab_prenotazione->delete(intval($idp));
            return 'eliminazione eseguita con successo!';
        }

        // trova prenotazione per ID
        public function trova_prenotazione($idp) {
            return $this->tab_prenotazione->find_by_id($idp);
        }

        ### FASE 1 - gestore prenota slot libero
        public function registra_disponibilita($idg, $data, $ora) {
            // Controlla se esiste già usando il metodo specializzato
            $existing = $this->tab_prenotazione->prenotazione_per_data($data, $idg);
            
            // Filtra per trovare se esiste già quella specifica ora
            foreach ($existing as $slot) {
                if ($slot['ora'] == $ora) {
                    return 'Errore: Disponibilità già esistente per quella data/ora';
                }
            }
            
            $mPrenotazione = new mPrenotazione($idg, $data, $ora, null);
            return $this->aggiungi_prenotazione($mPrenotazione);
        }

        ### FASE 2 - cliente sceglie solo dalla select
        public function prenota_slot_semplice($idp, $idc) {
            // Verifica che lo slot esista e sia ancora disponibile
            $slot = $this->tab_prenotazione->find_by_id($idp);
            
            if (!$slot) {
                return 'Errore: Slot non trovato';
            }
            
            // Aggiorna il record aggiungendo il cliente e senza specificare l'id prenotazione
            $updated_slot = [
                'idg' => $slot['idg'],
                'data' => $slot['data'],
                'ora' => $slot['ora'],
                'idc' => $idc
            ];
            return $this->tab_prenotazione->save($updated_slot);
        }

        // Ottieni disponibilità libere FORMATTATE per la select del cliente
        public function ottieni_disponibilita_per_select() {
            $tutti_slot = $this->tab_prenotazione->find_all();
            $disponibili_select = [];
            
            foreach ($tutti_slot as $slot) {
                if ($slot['idc'] === null) {
                    // Ottieni nome gestore
                    $gestore_nome = 'Gestore sconosciuto';
                    if ($this->tab_gestore) {
                        $gestore = $this->tab_gestore->find_by_id($slot['idg']);
                        $gestore_nome = $gestore ? $gestore['nome'] : 'Gestore sconosciuto';
                    }
                    
                    // Formatta per select: "Gestore - Data Ora"
                    $disponibili_select[] = [
                        'idp' => $slot['idp'],
                        'label' => $gestore_nome . ' - ' . $slot['data'] . ' ' . $slot['ora'],
                        'idg' => $slot['idg'],
                        'data' => $slot['data'],
                        'ora' => $slot['ora'],
                        'gestore_nome' => $gestore_nome
                    ];
                }
            }
            
            // Ordina per data e ora
            usort($disponibili_select, function($a, $b) {
                $date_cmp = strcmp($a['data'], $b['data']);
                if ($date_cmp == 0) {
                    return strcmp($a['ora'], $b['ora']);
                }
                return $date_cmp;
            });
            
            return $disponibili_select;
        }

        // Ottieni disponibilità libere (per visualizzazione dettagliata)
        public function ottieni_disponibilita() {
            try {
                // Query diretta per ottenere solo slot liberi con JOIN per il nome del gestore
                $query = "SELECT p.*, g.nome as gestore_nome 
                        FROM prenotazione p 
                        LEFT JOIN gestore g ON p.idg = g.idg 
                        WHERE p.idc IS NULL 
                        ORDER BY p.data, p.ora";
                
                // Usa la connessione PDO direttamente per questa query complessa
                $stmt = $this->tab_prenotazione->query($query);
                $disponibili = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                return $disponibili;
                
            } catch (Exception $e) {
                error_log("ERRORE in ottieni_disponibilita(): " . $e->getMessage());
                return [];
            }
        }

        // Metodo per ottenere prenotazioni filtrate per gestore e data
        public function prenotazioni_per_data($id_gestore = '', $data = '') {
            $tutte_prenotazioni = $this->ottieni_tutte_prenotazioni();
            $prenotazioni_filtrate = [];
            
            foreach ($tutte_prenotazioni as $prenotazione) {
                $match_gestore = empty($id_gestore) || $prenotazione['idg'] == $id_gestore;
                $match_data = empty($data) || $prenotazione['data'] == $data;
                
                // Filtra solo prenotazioni CONFERMATE (con idc)
                if ($match_gestore && $match_data && !empty($prenotazione['idc'])) {
                    $prenotazioni_filtrate[] = $prenotazione;
                }
            }
            
            return $prenotazioni_filtrate;
        }

        // Metodo per ottenere solo prenotazioni confermate
        public function ottieni_prenotazioni_confermate() {
            $tutte_prenotazioni = $this->ottieni_tutte_prenotazioni();
            $confermate = [];
            
            foreach ($tutte_prenotazioni as $prenotazione) {
                if (!empty($prenotazione['idc'])) {
                    $confermate[] = $prenotazione;
                }
            }
            
            return $confermate;
        }

        // Ottieni tutte le prenotazioni (disponibilità + confermate)
        public function ottieni_tutte_prenotazioni() {
            $prenotazioni = $this->tab_prenotazione->find_all();
            
            foreach ($prenotazioni as $key => $slot) {
                // Aggiungi nomi gestore e cliente se disponibili
                if ($this->tab_gestore) {
                    $gestore = $this->tab_gestore->find_by_id($slot['idg']);
                    $prenotazioni[$key]['gestore_nome'] = $gestore ? $gestore['nome'] : 'N/A';
                }
                if ($this->tab_cliente && $slot['idc']) {
                    $cliente = $this->tab_cliente->find_by_id($slot['idc']);
                    $prenotazioni[$key]['cliente_nome'] = $cliente ? $cliente['nome'] : 'N/A';
                } else {
                    $prenotazioni[$key]['cliente_nome'] = 'Disponibile';
                }
            }
            
            // Ordina per data e ora
            usort($prenotazioni, function($a, $b) {
                $date_cmp = strcmp($a['data'], $b['data']);
                if ($date_cmp == 0) {
                    return strcmp($a['ora'], $b['ora']);
                }
                return $date_cmp;
            });
            
            return $prenotazioni;
        }
    }