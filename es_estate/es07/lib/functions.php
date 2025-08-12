<?php

    # FUNZIONI

    function aggiunta_scrittura_elementi($tappa, $distanza) {
        $array_itinerario = unserialize( file_get_contents('db/itinerario.db'));
        $array_itinerario[ ] = [
                'tappa' => $tappa,
                'km' => (int)$distanza,
            ];
        file_put_contents('db/itinerario.db', serialize($array_itinerario));
    }

    function lista () {
        if (file_get_contents('db/itinerario.db') == '') {
                return [];
            } 
        else {
                return unserialize(file_get_contents('db/itinerario.db'));
            }
    }

    function costruzione_ol($itinerario) {
        $lista = '';
        foreach($itinerario as $tappa) {
            $lista .= '<li>' . ucfirst($tappa['tappa']) . 
                ' => ' . $tappa['km'] .' Km</li>';
        }
        return $lista;
    }