<?php

    namespace Piatti_preparabili;

     function ingrediente_scelto($idi) {
        if(!empty($idi) && is_integer($idi)) {
            $query = 'SELECT 
                i.idi,
                i.nome_i,
                GROUP_CONCAT(p.nome_p SEPARATOR "; ") as piatti
                FROM ingrediente i
                JOIN piatti_ingredienti pi ON i.idi = pi.idi
                JOIN piatto p ON pi.idp = p.idp
                WHERE i.idi = ?
                GROUP BY i.idi, i.nome_i
                ORDER BY i.nome_i';
            
            $statement = mysqli_prepare(\Funzioni\getConnection(), $query);
            mysqli_stmt_bind_param($statement, 'i', $idi);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            return mysqli_fetch_assoc($result);
        }
        else {
            return false;
        }
    }