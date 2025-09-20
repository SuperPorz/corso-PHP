<?php

    class cPrenotazione {

        public $lista_prenotazioni;
        private $tab_prenotazione;
        private $tab_gestore;
        private $tab_cliente;

        public function __construct(DatabaseTable $tab_prenotazione, DatabaseTable $tab_gestore = null, DatabaseTable $tab_cliente = null) {
            $this->tab_prenotazione = $tab_prenotazione;
            $this->tab_gestore = $tab_gestore;
            $this->tab_cliente = $tab_cliente;
            $this->lista_prenotazioni = [];
        }

        // Metodo originale - aggiunge prenotazione/disponibilità
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

        // Metodo originale - elimina prenotazione
        public function elimina_prenotazione($idp) {
            $this->tab_prenotazione->delete(intval($idp));
            return 'eliminazione eseguita con successo!';
        }

        // Metodo originale - trova prenotazione per ID
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
            
            if ($slot['idc'] !== null) {
                return 'Errore: Slot già prenotato da un altro cliente';
            }
            
            // Aggiorna il record aggiungendo il cliente
            $updated_slot = [
                'idp' => $slot['idp'],
                'idg' => $slot['idg'],
                'data' => $slot['data'],
                'ora' => $slot['ora'],
                'idc' => $idc
            ];
            
            try {
                $this->tab_prenotazione->save($updated_slot);
                return 'Prenotazione confermata con successo!';
            } catch (Exception $e) {
                return 'Errore durante la prenotazione: ' . $e->getMessage();
            }
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
        public function ottieni_disponibilita_libere() {
            $tutti_slot = $this->tab_prenotazione->find_all();
            $disponibili = [];
            
            foreach ($tutti_slot as $slot) {
                if ($slot['idc'] === null) {
                    // Aggiungi nome gestore se disponibile
                    if ($this->tab_gestore) {
                        $gestore = $this->tab_gestore->find_by_id($slot['idg']);
                        $slot['gestore_nome'] = $gestore ? $gestore['nome'] : 'N/A';
                    }
                    $disponibili[] = $slot;
                }
            }
            
            // Ordina per data e ora
            usort($disponibili, function($a, $b) {
                $date_cmp = strcmp($a['data'], $b['data']);
                if ($date_cmp == 0) {
                    return strcmp($a['ora'], $b['ora']);
                }
                return $date_cmp;
            });
            
            return $disponibili;
        }

        // Ottieni prenotazioni confermate (slot con cliente)
        public function ottieni_prenotazioni_confermate() {
            $tutti_slot = $this->tab_prenotazione->find_all();
            $confermate = [];
            
            foreach ($tutti_slot as $slot) {
                if ($slot['idc'] !== null) {
                    // Aggiungi nomi gestore e cliente se disponibili
                    if ($this->tab_gestore) {
                        $gestore = $this->tab_gestore->find_by_id($slot['idg']);
                        $slot['gestore_nome'] = $gestore ? $gestore['nome'] : 'N/A';
                    }
                    if ($this->tab_cliente) {
                        $cliente = $this->tab_cliente->find_by_id($slot['idc']);
                        $slot['cliente_nome'] = $cliente ? $cliente['nome'] : 'N/A';
                    }
                    $confermate[] = $slot;
                }
            }
            
            // Ordina per data e ora
            usort($confermate, function($a, $b) {
                $date_cmp = strcmp($a['data'], $b['data']);
                if ($date_cmp == 0) {
                    return strcmp($a['ora'], $b['ora']);
                }
                return $date_cmp;
            });
            
            return $confermate;
        }

        // Ottieni tutte le prenotazioni (disponibilità + confermate)
        public function ottieni_tutte_prenotazioni() {
            $tutti_slot = $this->tab_prenotazione->find_all();
            
            foreach ($tutti_slot as &$slot) {
                // Aggiungi nomi gestore e cliente se disponibili
                if ($this->tab_gestore) {
                    $gestore = $this->tab_gestore->find_by_id($slot['idg']);
                    $slot['gestore_nome'] = $gestore ? $gestore['nome'] : 'N/A';
                }
                if ($this->tab_cliente && $slot['idc']) {
                    $cliente = $this->tab_cliente->find_by_id($slot['idc']);
                    $slot['cliente_nome'] = $cliente ? $cliente['nome'] : 'N/A';
                } else {
                    $slot['cliente_nome'] = 'Disponibile';
                }
            }
            
            // Ordina per data e ora
            usort($tutti_slot, function($a, $b) {
                $date_cmp = strcmp($a['data'], $b['data']);
                if ($date_cmp == 0) {
                    return strcmp($a['ora'], $b['ora']);
                }
                return $date_cmp;
            });
            
            return $tutti_slot;
        }
    }