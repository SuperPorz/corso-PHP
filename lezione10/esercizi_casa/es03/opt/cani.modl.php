<?php

    namespace Cani;

    ######## FUNZIONI SPECIFICHE PER IL MODULO CANI ############

    function lista() {

        $query = "SELECT * FROM cani c JOIN padroni p ON c.id_p = p.id_p";
        $risultato_query = mysqli_query(\Funzioni\getConnection(), $query);
        $elenco = [ ];
        while ($tupla = mysqli_fetch_assoc($risultato_query)) {
            $elenco[] = $tupla;
        }
        return $elenco;        
    }

    function dettagli($id_c) {

        if (!empty($id_c)) {
            $query = "SELECT * FROM cani c JOIN padroni p ON c.id_p = p.id_p WHERE id_c = '$id_c'";
            $risultato_query = mysqli_query(\Funzioni\getConnection(), $query);
            return mysqli_fetch_assoc($risultato_query);
        }
        else {
            echo "DEBUG - Dati non validi -  - DETTAGLI<br>";
            return false;
        }
    }

    function aggiungi($nome, $data_n, $data_v, $id_p) {

        if (!empty($nome) && !empty($data_n) && !empty($data_v) && !empty($id_p)) {

            $nome_trim = trim($nome);
            $id_cane = \Funzioni\genera_id(6);
            $query_string = "INSERT INTO cani (id_c, nome, data_n, data_v, id_p) VALUES ('$id_cane', '$nome_trim', '$data_n', '$data_v', '$id_p')";
            mysqli_query(\Funzioni\getConnection(), $query_string); // osservazione: nella funz. aggiungi, non serve salvare risultato query in 1 variabile
            return true;
        }
        else {
            echo "ERRORE - DATI NON VALIDI - AGGIUNGI";
            return false;
        }
    }

    function modifica($id_c, $nome, $data_n, $data_v, $id_p) {

        if (!empty($id_c) && !empty($nome) && !empty($data_n) && !empty($data_v) && !empty($id_p)) {

            $query_string = "UPDATE cani SET nome = '$nome', data_n = '$data_n', data_v = '$data_v', id_p = '$id_p' WHERE id_c = '$id_c'";
            mysqli_query(\Funzioni\getConnection(), $query_string);
            return true;
        }
        else {
            echo "ERRORE - DATI NON VALIDI - MODIFICA";
            return false;
        }
    }

    function elimina($id_c) {
        if (!empty($id_c)) {
            $query_string = "DELETE FROM cani WHERE id_c = '$id_c'";
            mysqli_query(\Funzioni\getConnection(), $query_string);
            return true;
        }
        else {
            echo "ERRORE - DATI NON VALIDI - ELIMINA";
            return false;
        }
    }