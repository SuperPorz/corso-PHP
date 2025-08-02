<?php

    namespace Piatto;

    function lista() {
        $query = 
                'SELECT * FROM piatto ORDER BY nome_p';
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
                'SELECT * FROM piatto WHERE idp = :idp';
            $params = [':idp' => $idp];
            $query_with_params = \Funzioni\prepare($query_noparams, $params);
            $invio_query = mysqli_query(\Funzioni\getConnection(), $query_with_params);
            return mysqli_fetch_assoc($invio_query);
        }
        else {
            return false;
        }
    }

    function aggiungi($nome_piatto) {

        if(!empty($nome_piatto)) {
            
            $nome_piatto = trim($nome_piatto); #sanificazione
            $idp = \Funzioni\genera_id(6);

            #query inserimento dati
            $query = 'INSERT INTO piatto (idp, nome_p) VALUES ( ?, ?)';
            $statement = mysqli_prepare(\Funzioni\getConnection(), $query); # preparazione statement
            mysqli_stmt_bind_param($statement, 'ss', $idp, $nome_piatto);
            return mysqli_stmt_execute($statement);
        }
        else {
            return false;
        }
    }

    function modifica($idp, $nome_piatto) {

        if(!empty($idp) && !empty($nome_piatto)) {

            $nome_piatto = trim($nome_piatto); #sanificazione

            $query = 'UPDATE piatto SET nome_p = ? WHERE idp = ?';
            $statement = mysqli_prepare(\Funzioni\getConnection(), $query);
            mysqli_stmt_bind_param($statement, 'ss', $nome_piatto, $idp);
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