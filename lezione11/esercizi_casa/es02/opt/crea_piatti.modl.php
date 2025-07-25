<?php

    namespace Crea_piatti;

    function lista() {
        $query = 
                'SELECT * FROM piatti_ingredienti';
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
                'SELECT * FROM piatti_ingredienti WHERE idp = :idp';
            $params = [':idp' => $idp];
            $query_with_params = \Funzioni\prepare($query_noparams, $params);
            $invio_query = mysqli_query(\Funzioni\getConnection(), $query_with_params);
            return mysqli_fetch_assoc($invio_query);
        }
        else {
            return false;
        }
    }

    function aggiungi($idp, $array_ID_ingredienti) {

        if(!empty($idp) && !empty($array_ID_ingredienti)) {

            foreach($array_ID_ingredienti as $idi => $nome_ingrediente) {

                $query = 'INSERT INTO piatti_ingredienti (idp, idi) VALUES ( ?, ?)';
                $statement = mysqli_prepare(\Funzioni\getConnection(), $query); # preparazione statement
                mysqli_stmt_bind_param($statement, 'ss',$idp, $idi);
                mysqli_stmt_execute($statement);
            }
            return true;
        }
        else {
            return false;
        }
    }

    function modifica($idp, $array_ID_ingredienti) {

        if(!empty($idp) && !empty($array_ID_ingredienti)) {

            foreach($array_ID_ingredienti as $idi => $nome_ingrediente) {

                $query = 'UPDATE piatti_ingredienti SET idi = ? WHERE idp = ?';
                $statement = mysqli_prepare(\Funzioni\getConnection(), $query);
                mysqli_stmt_bind_param($statement, 'ss', $idi,$idp);
                mysqli_stmt_execute($statement);
            }
            return true;
        }
        else {
            return false;
        }
    }

    function elimina($idp) {

        if(!empty($idp)) {

            $query = 'DELETE FROM piatti_ingredienti WHERE idp = ?';
            $statement = mysqli_prepare(\Funzioni\getConnection(), $query);
            mysqli_stmt_bind_param($statement, 's', $idp);
            return mysqli_stmt_execute($statement);
        }
        else {
            return false;
        }
    }