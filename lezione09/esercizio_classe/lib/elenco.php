<?php

    # libreria per la gestione dell'elenco CANI

    namespace Elenco;

    #aggiungi CANE
    function aggiungi($nome, $anno_nascita) {
        $elenco = lista();
        $id = md5('elenco-'.microtime(true).rand(0, 1000).$nome);
        $elenco[ $id ] = [
            'nome' => $nome,
            'anno_nascita' => $anno_nascita
        ];
        $h = fopen('./elenco.db', 'w+');
        if ($h === false) {
            return false;
        } else {
            fwrite($h, serialize($elenco));
            fclose($h);
            return true;
        }
    }

    # funz che ritorna lista vuota se file non esiste, altrimenti restituisce lista unserialized
    function lista() {
        if (!file_exists('./elenco.db')) {
            return [];
        } else {
            return unserialize(file_get_contents('./elenco.db'));
        }
    }

    # funzione elimina nominativo CANE
    function elimina($id) {
        $elenco = lista();
        if (isset($elenco[$id])) {
            unset($elenco[$id]);
            $h = fopen('./elenco.db', 'w+');
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

    # funzione modifica nominativo CANE
    function modifica($id, $nome, $telefono) {
        $elenco = lista();
        if (isset($elenco[$id])) {
            $elenco[$id] = [
                'nome' => $nome,
                'telefono' => $telefono
            ];
            $h = fopen('./elenco.db', 'w+');
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
