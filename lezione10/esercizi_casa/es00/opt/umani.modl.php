<?php

    
    # libreria per la gestione degli umanoidi
    namespace Umani;

    # aggiunge una persona alla lista
    function aggiungi($nome, $cognome, $numero) {

        if (!empty($nome) && !empty($cognome) && !empty($numero)) {
            $nome = trim($nome);
            $cognome = trim($cognome);
            $numero = trim($numero);
            $sql = "INSERT INTO umani (nome, cognome, numero) VALUES ('$nome', '$cognome', '$numero')" ;
            $res = mysqli_query(\Funzioni\getConnection(), $sql);
            return $res;
        } else {
            echo "DEBUG - Dati non validi<br>";
            return false;
        }

    }

    # modifica una persona nella lista
    function modifica($id_p, $nome, $cognome, $numero) {
        if (!empty($id_p) && is_numeric($id_p) && !empty($nome) && !empty($cognome) && !empty($numero)) {
            $id_p = intval($id_p);
            $nome = trim($nome);
            $cognome = trim($cognome);
            $numero = trim($numero);
            $sql = "UPDATE umani SET nome = '$nome', cognome = '$cognome', numero = '$numero' WHERE id_p = '$id_p'";
            $res = mysqli_query(\Funzioni\getConnection(), $sql);
            return $res;
        } else {
            echo "DEBUG - Dati non validi<br>";
            return false;
        }
    }

    # elimina una persona dalla lista
    function elimina($id_p) {
        if( ! empty($id_p) && is_numeric($id_p) ) {
            $id_p = intval($id_p);
            $sql = "DELETE FROM umani WHERE id_p = '$id_p'";
            $res = mysqli_query(\Funzioni\getConnection(), $sql);
            return $res;
        } else {
            echo "DEBUG - Dati non validi<br>";
            return false;
        }
    }

    # restituisce la lista delle persone
    function lista() {

        $sql = "SELECT * FROM umani";
        $res = mysqli_query(\Funzioni\getConnection(), $sql);
        $persone = [];
        while ($row = mysqli_fetch_assoc($res)) {
            $persone[] = $row;
        }
        return $persone;
    }

    # restituisce i dettagli di una persona
    function dettagli($id_p) {
        if( !empty($id_p) && is_numeric($id_p) ) {
            $id_p = intval($id_p);
            $sql = "SELECT * FROM umani WHERE id_p = '$id_p'";
            $res = mysqli_query(\Funzioni\getConnection(), $sql);
            return mysqli_fetch_assoc($res);
        } else {
            echo "DEBUG - Dati non validi<br>";
            return false;
        }
    }
