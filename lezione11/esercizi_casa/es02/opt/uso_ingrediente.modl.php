<?php

    namespace Uso_ingrediente;

    function lista() {
        $query = 'SELECT 
                i.idi,
                i.nome_i,
                GROUP_CONCAT(p.nome_p SEPARATOR "; ") as piatti
                FROM ingrediente i
                LEFT JOIN piatti_ingredienti pi ON i.idi = pi.idi
                LEFT JOIN piatto p ON pi.idp = p.idp
                GROUP BY i.idi, i.nome_i
                ORDER BY i.nome_i';
        
        $invio_query = mysqli_query(\Funzioni\getConnection(), $query);
        $piatti = [];
        while ($riga = mysqli_fetch_assoc($invio_query)){
            $piatti[] = $riga;
        }
        return $piatti;
    }