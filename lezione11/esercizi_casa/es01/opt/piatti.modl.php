<?php

    namespace Piatti;

    function lista() {
        $query = 
                'SELECT * FROM piatto';
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

    function aggiungi($nome_piatto, $array_ingredienti) {

        if(!empty($nome_piatto) && !empty($array_ingredienti)) {
            
            $nome_piatto = trim($nome_piatto); #sanificazione
            $idp = \Funzioni\genera_id(6);

            $stringa_ingredienti = '';
            foreach($array_ingredienti as $k => $v) {

                $stringa_ingredienti .= $v . '; ';
            }

            #query inserimento dati
            $query = 'INSERT INTO piatto (idp, nome_p, ingredienti) VALUES ( ?, ?, ? )';
            $statement = mysqli_prepare(\Funzioni\getConnection(), $query); # preparazione statement
            mysqli_stmt_bind_param($statement, 'sss', $idp, $nome_piatto, $stringa_ingredienti);
            return mysqli_stmt_execute($statement);
        }
        else {
            return false;
        }
    }

    function modifica($idp, $nome_piatto, $array_ingredienti) {

        if(!empty($idp) && !empty($nome_piatto) && !empty($array_ingredienti)) {

            $nome_piatto = trim($nome_piatto); #sanificazione

            $stringa_ingredienti = '';
            foreach($array_ingredienti as $k => $v) {

                $stringa_ingredienti .= $v . '; ';
            }

            $query = 'UPDATE piatto SET nome_p = ?, ingredienti = ? WHERE idp = ?';
            $statement = mysqli_prepare(\Funzioni\getConnection(), $query);
            mysqli_stmt_bind_param($statement, 'sss', $nome_piatto, $stringa_ingredienti, $idp);
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