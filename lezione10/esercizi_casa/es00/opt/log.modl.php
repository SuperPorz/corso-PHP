<?php

    
    # libreria per la gestione del pannello LOG
    namespace Log;

    # restituisce LA TABELLA LOG_
    function lista() {

        $sql = "SELECT * FROM log_";
        $res = mysqli_query(\Funzioni\getConnection(), $sql);
        $lista_log = [];
        while ($row = mysqli_fetch_assoc($res)) {
            $lista_log[] = $row;
        }
        return $lista_log;
    }

    # elimina un'azione dal pannello LOG (NON AGISCE SULLA TABELLA DELLE PERSONE!!!!)'
    function elimina_singolo($id_log) {
        if( ! empty($id_log) && is_numeric($id_log) ) {
            $id_log = intval($id_log);
            $sql = "DELETE FROM log_ WHERE id_log = '$id_log'";
            $res = mysqli_query(\Funzioni\getConnection(), $sql);
            return $res;
        } else {
            echo "DEBUG - Dati non validi - ELIMINA SINGOLO<br>";
            return false;
        }
    }

    # svuota la cronologia
    function elimina_tutto() {
        
        $sql = "DELETE FROM log_";
        mysqli_query(\Funzioni\getConnection(), $sql);
        return true;
    }