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