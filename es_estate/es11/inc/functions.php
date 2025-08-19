<?php

    function lista() {
        if (!file_exists('inc/studenti.db')) {
            return [];
        } else {
            $contenuto = file_get_contents('inc/studenti.db');
            if ($contenuto === false || empty($contenuto)) {
                return [];
            }
            $risultato = unserialize($contenuto);
            return $risultato === false ? [] : $risultato;
        }
    }

    function aggiungi($nome, $array_voti) {
        $elenco = lista();
        $id = md5('elenco-'.microtime(true).rand(0, 1000).$nome);
        $elenco[ $id ] = [
            'nome' => $nome,
            'voti' => []
        ];
        foreach($array_voti as $voto) {
            $elenco[ $id ]['voti'][] = floatval($voto);
        }

        $h = fopen('inc/studenti.db', 'w+');
        if ($h === false) {
            return false;
        } else {
            fwrite($h, serialize($elenco));
            fclose($h);
            return true;
        }
    }

    function modifica($id, $nome, $array_voti) {
        $elenco = lista();
        if (isset($elenco[$id])) {
            $elenco[$id] = [
                'nome' => $nome,
                'voti' => $array_voti
            ];
            $h = fopen('inc/studenti.db', 'w+');
            if ($h === false) {
                return false;
            } else {
                fwrite($h, serialize($elenco));
                fclose($h);
                return true;
            }
        } else {
            return false;
        }
    }

    function elimina($id) {
        $elenco = lista();
        if (isset($elenco[$id])) {
            unset($elenco[$id]);
            $h = fopen('inc/studenti.db', 'w+');
            if ($h === false) {
                return false;
            } else {
                fwrite($h, serialize($elenco));
                fclose($h);
                return true;
            }
        } else {
            return false;
        }
    }

    function crea_ul($array) {
        $stringa = '<ul>';
        foreach($array as $k => $v) {
            $stringa .= '<li>' .$k. ': media voti => ' .$v.'</li>';
        }
        $stringa .= '</ul>';

        return $stringa;
    }

    function crea_ul_nomi($array) {
        $stringa = '<ul>';
        foreach($array as $nome) {
            $stringa .= '<li>' .$nome. '</li>';
        }
        $stringa .= '</ul>';

        return $stringa;
    }