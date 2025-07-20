<?php

    namespace Ingredienti;

    function lista() {
        $query = 'SELECT * FROM ingrediente';
        $invio_query = mysqli_query(\Funzioni\getConnection(), $query);
        $ingredienti = [];
        while ($riga = mysqli_fetch_assoc($invio_query)){
            $ingredienti[] =$riga;
        }
        return $ingredienti;
    }

    function dettagli($idi) {

        if(!empty($idi)) {
            $query_noparams = 'SELECT * FROM ingrediente where idi = :idi';
            $params = [':idi' => $idi];
            $query_with_params = \Funzioni\prepare($query_noparams, $params);
            $invio_query = mysqli_query(\Funzioni\getConnection(), $query_with_params);
            return mysqli_fetch_assoc($invio_query);
        }
        else {
            return false;
        }
    }

    function aggiungi($nome_ingrediente) {

        if(!empty($nome_ingrediente)) {
            
            $nome_ingrediente = trim($nome_ingrediente); #sanificazione
            $query = 'INSERT INTO ingrediente (nome_i) VALUES ( ? )';
            $statement = mysqli_prepare(\Funzioni\getConnection(), $query); # preparazione statement
            mysqli_stmt_bind_param($statement, 's', $nome_ingrediente);
            return mysqli_stmt_execute($statement);
        }
        else {
            return false;
        }
    }

    function modifica($idi, $nome_ingrediente) {

        if(!empty($idi) && is_numeric($idi) && !empty($nome_ingrediente)) {

            $idi = intval($idi); #sanificazione
            $nome_ingrediente = trim($nome_ingrediente); #sanificazione
            $query = 'UPDATE ingrediente SET nome_i = ? WHERE idi = ?';
            $statement = mysqli_prepare(\Funzioni\getConnection(), $query);
            mysqli_stmt_bind_param($statement, 'si', $nome_ingrediente, $idi);
            return mysqli_stmt_execute($statement);
        }
        else {
            return false;
        }
    }

    function elimina($idi) {

        if(!empty($idi) && is_numeric($idi)) {

            $idi = intval($idi);
            $query = 'DELETE FROM ingrediente WHERE idi = ?';
            $statement = mysqli_prepare(\Funzioni\getConnection(), $query);
            mysqli_stmt_bind_param($statement, 'i', $idi);
            return mysqli_stmt_execute($statement);
        }
        else {
            return false;
        }
    }