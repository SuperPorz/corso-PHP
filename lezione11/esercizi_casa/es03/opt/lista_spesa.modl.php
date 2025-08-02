<?php

    namespace Lista_spesa;

    function menu_scelto($idp) {
        if(!empty($idp)) {
            $query = 'SELECT i.idi, i.nome_i
                FROM piatto p
                LEFT JOIN piatti_ingredienti pi ON p.idp = pi.idp
                LEFT JOIN ingrediente i ON pi.idi = i.idi
                WHERE p.idp = ?';
            
            $statement = mysqli_prepare(\Funzioni\getConnection(), $query);
            mysqli_stmt_bind_param($statement, 's', $idp);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        else {
            return false;
        }
    }

    function piatti_associati() {
        $query = 'SELECT DISTINCT p.idp, p.nome_p
            FROM piatto p
            LEFT JOIN piatti_ingredienti pi ON p.idp = pi.idp
            LEFT JOIN ingrediente i ON pi.idi = i.idi
            WHERE i.nome_i IS NOT NULL';
        
        $statement = mysqli_prepare(\Funzioni\getConnection(), $query);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }