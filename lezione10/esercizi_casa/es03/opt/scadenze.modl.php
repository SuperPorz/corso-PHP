<?php

    namespace Scadenze;

    ######## FUNZIONI SPECIFICHE PER IL MODULO VACCINAZIONI SCADUTE > 1 ANNO ############

    function scadenze() {

        $query = "SELECT c.id_c, c.nome, c.data_n, c.data_v, p.nome_p, p.telefono FROM cani c JOIN padroni p ON c.id_p = p.id_p WHERE data_v < DATE_SUB(NOW(),INTERVAL 1 YEAR);";
        $risultato_query = mysqli_query(\Funzioni\getConnection(), $query);
        $elenco = [ ];
        while ($tupla = mysqli_fetch_assoc($risultato_query)) {
            $elenco[] = $tupla;
        }
        return $elenco;    
    }

    function scadenze_padrone() {

        $query = "SELECT p.* FROM cani c JOIN padroni p ON c.id_p = p.id_p WHERE data_v < DATE_SUB(NOW(),INTERVAL 1 YEAR);";
        $risultato_query = mysqli_query(\Funzioni\getConnection(), $query);
        $elenco = [ ];
        while ($tupla = mysqli_fetch_assoc($risultato_query)) {
            $elenco[] = $tupla;
        }
        return $elenco;
    }