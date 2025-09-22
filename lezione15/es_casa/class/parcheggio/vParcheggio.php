<?php

    class vParcheggio {

        private $tab_parcheggio;

        public function __construct(DatabaseTable $tab_parcheggio)
        {
            $this->tab_parcheggio = $tab_parcheggio;
        }

        public function parcheggi_registrati() {
            return $this->tab_parcheggio->find_all();
        }

        // query specializzata (soste per uno specifico parcheggio)
        private function soste_parcheggio($idp, $SWITCH) {
            $query = 'SELECT s.ids, a.targa, a.proprietario, p.nome, p.tariffa, s.inizio_sosta, s.fine_sosta, s.costo_sosta
                FROM sosta s
                JOIN auto a ON s.ida = a.ida
                JOIN parcheggio p ON p.idp = s.idp
                WHERE s.fine_sosta IS ' .$SWITCH. ' NULL AND s.idp = :idp'; // Usa s.idp per evitare ambiguità
            $parameters = ['idp' => $idp]; // Il placeholder è :idp, quindi la chiave deve essere 'idp'
            $result = $this->tab_parcheggio->query($query, $parameters);
            return $result->fetchAll();
        }

        public function render_parcheggio($idp) {

            //preparazione
            include_once 'inc/render.php';
            $idp = intval($idp);
            $template = 'tpl/parcheggio.html';
            $lista_parcheggi = $this->parcheggi_registrati();
            $str_parcheggi = '';
            $select_park = '';
            $str_soste_aperte = '';
            $str_soste_chiuse = '';

            // tabella PARCHEGGI REGISTRATI
            foreach($lista_parcheggi as $parcheggio) {
                $tab = 'tpl/blocks/table.park.html';
                $array = [
                    'idp' => $parcheggio['idp'],
                    'nome' => $parcheggio['nome'],
                    'tariffa' => $parcheggio['tariffa'],
                ];
                $str_parcheggi .= Render\render($tab, $array);
            }

            // select PARCHEGGI
            foreach($lista_parcheggi as $parcheggio) {
                $select_park .= '<option value=' . $parcheggio['idp'] . '>NOME: ' . $parcheggio['nome'] 
                    . ' TARIFFA: ' . $parcheggio['tariffa'] . '</option>';
            }
            

            // tabella SOSTE APERTE PER PARCHEGGIO SPECIFICO
            if (!empty($idp)) {
                foreach($this->soste_parcheggio($idp, '') as $sosta) {
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
            }

            // tabella SOSTE CHIUSE PER PARCHEGGIO SPECIFICO
            if (!empty($idp)) {
                foreach($this->soste_parcheggio($idp, 'NOT') as $sosta) {
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
            }

            // RENDER FINALE
            $dati_render = [
                'lista_parcheggi' => $str_parcheggi,
                'select_parcheggi' => $select_park,
                'soste_aperte' => $str_soste_aperte,
                'soste_chiuse' => $str_soste_chiuse
            ];
            return Render\render($template, $dati_render);
        }
    }