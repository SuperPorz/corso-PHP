<?php

    namespace Piatti;

    function lista() {
        $query = 
                'SELECT p.idp, p.nome_p, i.idi, i.nome_i
                FROM piatto p
                JOIN ingrediente i ON p.idi = i.idi';
        $invio_query = mysqli_query(\Funzioni\getConnection(), $query);
        $piatti = [];
        while ($riga = mysqli_fetch_assoc($invio_query)){
            $piatti[] =$riga;
        }
        return $piatti;
    }

    function dettagli($idp) {

        if(!empty($idp)) {
            $query_noparams = 
                'SELECT p.idp, p.nome_p, i.idi, i.nome_i
                FROM piatto p
                JOIN ingrediente i ON p.idi = i.idi
                WHERE idi = :idi';
            $params = [':idp' => $idp];
            $query_with_params = \Funzioni\prepare($query_noparams, $params);
            $invio_query = mysqli_query(\Funzioni\getConnection(), $query_with_params);
            return mysqli_fetch_assoc($invio_query);
        }
        else {
            return false;
        }
    }

    function aggiungi($nome_piatto, $idi) {

        if(!empty($nome_piatto)) {
            
            $nome_piatto = trim($nome_piatto); #sanificazione
            $idp = \Funzioni\genera_id(6);
            $idi = intval($idi); #sanificazione

            #query inserimento dati
            $query = 'INSERT INTO piatto (idp, nome_p, idi) VALUES ( ?, ?, ? )';
            $statement = mysqli_prepare(\Funzioni\getConnection(), $query); # preparazione statement
            mysqli_stmt_bind_param($statement, 'ssi', $idp, $nome_piatto, $idi);
            return mysqli_stmt_execute($statement);
        }
        else {
            return false;
        }
    }

    function modifica($idp, $nome_piatto, $idi) {

        if(!empty($idp) && !empty($nome_piatto) && !empty($idi) && is_numeric($idi)) {

            $idi = intval($idi); #sanificazione
            $nome_piatto = trim($nome_piatto); #sanificazione

            $query = 'UPDATE piatto SET nome_i = ?, idi = ? WHERE idp = ?';
            $statement = mysqli_prepare(\Funzioni\getConnection(), $query);
            mysqli_stmt_bind_param($statement, 'si', $nome_piatto, $idi, $idp);
            return mysqli_stmt_execute($statement);
        }
        else {
            return false;
        }
    }

    function elimina($idp) {

        if(!empty($idp)) {

            $query = 'DELETE FROM piatto WHERE idp = ?';
            $statement = mysqli_prepare(\Funzioni\getConnection(), $query);
            mysqli_stmt_bind_param($statement, 's', $idp);
            return mysqli_stmt_execute($statement);
        }
        else {
            return false;
        }
    }