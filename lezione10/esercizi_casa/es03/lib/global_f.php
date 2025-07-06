<?php

    namespace Funzioni;

    function render($tpl, $dati) {

        $contenuto = file_get_contents($tpl);
        foreach ($dati as $k => $v) {
            $contenuto = str_replace('{{' . $k . '}}', $v, $contenuto);
        }
        return $contenuto;
    }

    function getConnection() {

        return $GLOBALS['conn'];

    }
    
    function genera_id($length = 8){

        $hash = md5('app-cani' . microtime(true) . rand(11, 96578));
        $hash_ridotto = substr($hash, 0, $length);
        $caratteri_splittati = str_split($hash_ridotto, );
        shuffle($caratteri_splittati);

        return implode($caratteri_splittati);

        }