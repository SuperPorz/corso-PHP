<?php

    class vAuto {

        private $tab_auto;

        public function __construct(DatabaseTable $tab_auto)
        {
            $this->tab_auto = $tab_auto;
        }

        public function auto_registrate() {
            return $this->tab_auto->find_all();
        }

        public function render_auto() {

            //preparazione
            include_once 'inc/render.php';
            $template = 'tpl/auto.html';
            $lista_auto = $this->auto_registrate();
            $str_auto = '';

            // tabella AUTO REGISTRATE
            foreach($lista_auto as $auto) {
                $tab = 'tpl/blocks/table.auto.html';
                $array = [
                    'ida' => $auto['ida'],
                    'targa' => $auto['targa'],
                    'proprietario' => $auto['proprietario'],
                ];
                $str_auto .= Render\render($tab, $array);
            }

            // RENDER FINALE
            $dati_render = [
                'lista_auto' => $str_auto
            ];
            return Render\render($template, $dati_render);            
        }
    }