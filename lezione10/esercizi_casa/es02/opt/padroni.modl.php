<?php

    namespace Padroni;

    ######## FUNZIONI SPECIFICHE PER IL MODULO CANI ############

    function lista() {

        $query = "SELECT * FROM padroni";
        $risultato_query = mysqli_query(\Funzioni\getConnection(), $query);
        $elenco = [ ];
        while ($tupla = mysqli_fetch_assoc($risultato_query)) {
            $elenco[] = $tupla;
        }
        return $elenco;        
    }

    function dettagli($id_p) {

        if (!empty($id_p)) {
            $query = "SELECT * FROM padroni WHERE id_p = '$id_p'";
            $risultato_query = mysqli_query(\Funzioni\getConnection(), $query);
            return mysqli_fetch_assoc($risultato_query);
        }
        else {
            echo "DEBUG - Dati non validi -  - DETTAGLI<br>";
            return false;
        }
    }

    function aggiungi($nome) {

        if (!empty($nome)) {
            $nome_trim = trim($nome);
            $id_padrone = \Funzioni\genera_id(6);
            $query_string = "INSERT INTO padroni (id_p, nome_p) VALUES ('$id_padrone', '$nome_trim')";
            mysqli_query(\Funzioni\getConnection(), $query_string); // osservazione: nella funz. aggiungi, non serve salvare risultato query in 1 variabile
            return true;
        }
        else {
            echo "ERRORE - DATI NON VALIDI - AGGIUNGI";
            return false;
        }
    }

    function modifica($id_p, $nome) {

        if (!empty($id_p) && !empty($nome)) {

            $query_string = "UPDATE padroni set nome_p = '$nome' WHERE id_p = '$id_p'";
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
            $query_string = "DELETE FROM padroni WHERE id_c = '$id_c'";
            mysqli_query(\Funzioni\getConnection(), $query_string);
            return true;
        }
        else {
            echo "ERRORE - DATI NON VALIDI - ELIMINA";
            return false;
        }
    }