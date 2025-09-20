<?php

    class cPrenotazione {

        public $lista_prenotazioni;
        private $tab_prenotazione;

        public function __construct(DatabaseTable $tab_prenotazione) {
            $this->tab_prenotazione = $tab_prenotazione;
            $this->lista_prenotazioni = [];
        }

        public function aggiungi_prenotazione(mprenotazione $prenotazione) {
            $array = [
                'idg' => $prenotazione->idg,
                'data' => $prenotazione->data,
                'ora' => $prenotazione->ora,
                'idc' => $prenotazione->idc
            ];
            $this->tab_prenotazione->save($array);
            return 'aggiunta eseguita con successo!';
        }

        public function elimina_prenotazione($idp) {
            $this->tab_prenotazione->delete(intval($idp));
            return 'eliminazione eseguita con successo!';
        }

        public function trova_prenotazione($idp) {
            return $this->tab_prenotazione->find_by_id($idp);
        }
    }