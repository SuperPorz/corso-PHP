<?php

    class vSosta {

        private $tab_sosta;
        private $tab_auto;
        private $tab_parcheggio;

        public function __construct(DatabaseTable $tab_sosta, 
            DatabaseTable $tab_auto, DatabaseTable $tab_parcheggio)
        {
            $this->tab_sosta = $tab_sosta;
            $this->tab_auto = $tab_auto;
            $this->tab_parcheggio = $tab_parcheggio;
        }

        public function tab_sosta_registrate() {
            return $this->tab_sosta->find_all();
        }

        // query specializzata (switch per passare da IS a IS NOT) -->DRY (Dont Repeat Yourself)
        private function soste_aperte_chiuse($SWITCH = '') {
            $query = 'SELECT s.ids, a.targa, a.proprietario, p.nome, p.tariffa, s.inizio_sosta, s.fine_sosta, s.costo_sosta
                FROM sosta s
                JOIN auto a ON s.ida = a.ida
                JOIN parcheggio p ON p.idp = s.idp
                WHERE s.fine_sosta IS ' .$SWITCH. ' NULL;';
            $result = $this->tab_sosta->query($query);
            return $result->fetchAll();
        }

        // query specializzata
        private function auto_no_sosta() {
            $query = 'SELECT * FROM auto WHERE ida NOT IN (
                        SELECT ida
                        FROM sosta
                        WHERE fine_sosta IS NULL
                    );';
            $result = $this->tab_sosta->query($query);
            return $result->fetchAll();
        }

        public function render_soste() {

            //preparazione
            include_once 'inc/render.php';
            $template = 'tpl/sosta.html';
            $auto_libere = $this->auto_no_sosta();
            $lista_parcheggi = $this->tab_parcheggio->find_all();
            $str_auto = '';
            $str_parcheggi = '';
            $str_soste_aperte = '';
            $str_soste_chiuse = '';

            // select AUTO
            foreach($auto_libere as $auto) {
                $str_auto .= '<option value=' .$auto['ida']. '>TARGA: ' . $auto['targa'] 
                    . ' PROPRIETARIO.: ' . $auto['proprietario'] . '</option>';
            }

            // select PARCHEGGI
            foreach($lista_parcheggi as $parcheggio) {
                $str_parcheggi .= '<option value=' .$parcheggio['idp']. '>NOME: ' . $parcheggio['nome'] 
                    . ' TARIFFA: ' . $parcheggio['tariffa'] . '</option>';
            }

            // tabella SOSTE APERTE
            foreach($this->soste_aperte_chiuse() as $sosta) {
                $tab = 'tpl/blocks/table.sosta.html';
                $array = [
                    'ids' => $sosta['ids'],
                    'targa' => $sosta['targa'],
                    'proprietario' => $sosta['proprietario'],
                    'nome' => $sosta['nome'],
                    'tariffa' => $sosta['tariffa'],
                    'inizio_sosta' => $sosta['inizio_sosta'],
                    'fine_sosta' => '',
                    'costo_sosta' => ''
                ];
                $str_soste_aperte .= Render\render($tab, $array);
            }

            // tabella SOSTE CHIUSE
            foreach($this->soste_aperte_chiuse('NOT') as $sosta) {
                $tab = 'tpl/blocks/table.sosta.html';
                $array = [
                    'ids' => $sosta['ids'],
                    'targa' => $sosta['targa'],
                    'proprietario' => $sosta['proprietario'],
                    'nome' => $sosta['nome'],
                    'tariffa' => $sosta['tariffa'],
                    'inizio_sosta' => $sosta['inizio_sosta'],
                    'fine_sosta' => $sosta['fine_sosta'],
                    'costo_sosta' => $sosta['costo_sosta']
                ];
                $str_soste_chiuse .= Render\render($tab, $array);
            }

            // RENDER FINALE
            $dati_render = [
                'lista_auto' => $str_auto,
                'lista_parcheggi' => $str_parcheggi,
                'soste_aperte' => $str_soste_aperte,
                'soste_chiuse' => $str_soste_chiuse
            ];
            return Render\render($template, $dati_render);            
        }
    }