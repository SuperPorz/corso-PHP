<?php

    namespace Crea_piatti;

    function lista() {
    $query = 'SELECT 
            p.idp,
            p.nome_p,
            GROUP_CONCAT(i.nome_i SEPARATOR "; ") as ingredienti
            FROM piatto p
            LEFT JOIN piatti_ingredienti pi ON p.idp = pi.idp
            LEFT JOIN ingrediente i ON pi.idi = i.idi
            GROUP BY p.idp, p.nome_p
            ORDER BY p.nome_p';
    
    $invio_query = mysqli_query(\Funzioni\getConnection(), $query);
    $piatti = [];
    while ($riga = mysqli_fetch_assoc($invio_query)){
        $piatti[] = $riga;
    }
    return $piatti;
}

    function dettagli($idp) {
        if(!empty($idp)) {
            $query = 'SELECT 
                    p.idp,
                    p.nome_p,
                    i.idi,
                    GROUP_CONCAT(i.nome_i SEPARATOR "; ") as ingredienti
                    FROM piatto p
                    LEFT JOIN piatti_ingredienti pi ON p.idp = pi.idp
                    LEFT JOIN ingrediente i ON pi.idi = i.idi
                    WHERE p.idp = ?
                    GROUP BY p.idp, p.nome_p';
            
            $statement = mysqli_prepare(\Funzioni\getConnection(), $query);
            mysqli_stmt_bind_param($statement, 's', $idp);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            return mysqli_fetch_assoc($result);
        }
        else {
            return false;
        }
    }

    function aggiungi($idp, $array_ID_ingredienti) {

        if(!empty($idp) && !empty($array_ID_ingredienti)) {

            foreach($array_ID_ingredienti as $idi) {

                if(is_numeric($idi)) { // Verifico che $idi sia un numero valido
                    $idi = intval($idi); // Converto in intero
                    
                    $query = 'INSERT INTO piatti_ingredienti (idp, idi) VALUES (?, ?)';
                    $statement = mysqli_prepare(\Funzioni\getConnection(), $query);
                    mysqli_stmt_bind_param($statement, 'si', $idp, $idi); // 's' per string, 'i' per integer
                    mysqli_stmt_execute($statement);
                }
            }
            return true;
        }
        else {
            return false;
        }
    }

    function modifica($idp, $array_ID_ingredienti) {

        if(!empty($idp) && !empty($array_ID_ingredienti)) {

            // STEP 1: Elimina tutte le associazioni esistenti per questo piatto
            $query_delete = 'DELETE FROM piatti_ingredienti WHERE idp = ?';
            $stmt_delete = mysqli_prepare(\Funzioni\getConnection(), $query_delete);
            mysqli_stmt_bind_param($stmt_delete, 's', $idp);
            mysqli_stmt_execute($stmt_delete);
            
            // STEP 2: Inserisci le nuove associazioni
            foreach($array_ID_ingredienti as $idi) {
                
                // Verifica che $idi sia un numero valido
                if(is_numeric($idi)) {
                    $idi = intval($idi); // Converti in intero
                    
                    $query_insert = 'INSERT INTO piatti_ingredienti (idp, idi) VALUES (?, ?)';
                    $stmt_insert = mysqli_prepare(\Funzioni\getConnection(), $query_insert);
                    mysqli_stmt_bind_param($stmt_insert, 'si', $idp, $idi);
                    mysqli_stmt_execute($stmt_insert);
                }
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