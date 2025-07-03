<?php

    
    # libreria per la gestione degli umanoidi
    namespace Umani;

    // Funzione 1: Troncare l'hash MD5 con shuffle
    function genera_id($length = 8) {
        $hash = md5('registro' . microtime(true) . rand(15, 5000));
        $hash_ridotto = substr($hash, 0, $length);
        
        $caratteri = str_split($hash_ridotto); // Converte la stringa in array di caratteri
        shuffle($caratteri); // Rimescola i caratteri
        return implode('', $caratteri); // Riconverte in stringa
    }

    # aggiunge una persona alla lista
    function aggiungi($nome, $cognome, $numero) {

        if (!empty($nome) && !empty($cognome) && !empty($numero)) {
            $nome = trim($nome);
            $cognome = trim($cognome);
            $numero = trim($numero);
            $hash = genera_id(6);
            $curr_date = date("d/m/Y");
            $curr_hour = date("h:i");

            $sql1 = "INSERT INTO umani (id_p, nome, cognome, numero) VALUES ('$hash', '$nome', '$cognome', '$numero')" ;
            /* $sql2 = "INSERT INTO log_ (azione, id_p, nome_v, nome_n, cognome_v, cognome_n, numero_v, numero_n, data_az, ora_az) 
                     VALUES ('aggiungi', '$hash', '', '$nome', '', '$cognome', '', '$numero', '$curr_date', '$curr_hour')"; */
            mysqli_query(\Funzioni\getConnection(), $sql1);
            // mysqli_query(\Funzioni\getConnection(), $sql2);
            return true;
        } else {
            echo "DEBUG - Dati non validi - AGGIUNGI <br>";
            return false;
        }

    }

    # modifica una persona nella lista
    function modifica($id_p, $nome, $cognome, $numero) {
        if (!empty($id_p) && !empty($nome) && !empty($cognome) && !empty($numero)) {
            $nome = trim($nome);
            $cognome = trim($cognome);
            $numero = trim($numero);
            $curr_date = date("d/m/Y");
            $curr_hour = date("h:i");

            $sql1 = "UPDATE umani SET nome = '$nome', cognome = '$cognome', numero = '$numero' WHERE id_p = '$id_p'";
            /* $sql2 = "INSERT INTO log_ (azione, id_p, nome_v, nome_n, cognome_v, cognome_n, numero_v, numero_n, data_az, ora_az)
                    VALUES (
                        'modifica',
                        (SELECT (nome_n) FROM log_ WHERE id_p = '$id_p'), #---------------# nome_v
                        '$nome', #--------------------------------------------------------# nome_n
                        (SELECT (cognome_n) FROM log_ WHERE id_p = '$id_p'), #------------# cognome_v
                        '$cognome', #-----------------------------------------------------# cognome_n
                        (SELECT (numero_n) FROM log_ WHERE id_p = '$id_p'), #-------------# numero_v
                        '$numero', #------------------------------------------------------# numero_n
                        '$curr_date', #---------------------------------------------------# data_az
                        '$curr_hour', #---------------------------------------------------# ora_az
                    WHERE id_p = '$id_p'";                                                    
            var_dump($sql1, $sql2); */

            mysqli_query(\Funzioni\getConnection(), $sql1);
            // mysqli_query(\Funzioni\getConnection(), $sql2);
            return true;
        } else {
            echo "DEBUG - Dati non validi - MODIFICA<br>";
            return false;
        }
    }

    # elimina una persona dalla lista
    function elimina($id_p) {
        if(!empty($id_p)) {
            $curr_date = date("d/m/Y");
            $curr_hour = date("h:i");
            
            $sql1 = "DELETE FROM umani WHERE id_p = '$id_p'";
            /* $sql2 = "INSERT INTO log_ (azione, id_p, nome_v, nome_n, cognome_v, cognome_n, numero_v, numero_n, data_az, ora_az)
                    VALUES (
                        'elimina',
                        'val_eliminato', #------------# nome_v
                        'val_eliminato', #------------# nome_n
                        'val_eliminato', #------------# cognome_v
                        'val_eliminato', #------------# cognome_n
                        'val_eliminato', #------------# numero_v
                        'val_eliminato', #------------# numero_n
                        '$curr_date', #---------------# data_az
                        '$curr_hour', #---------------# ora_az
                    WHERE id_p = '$id_p'"; */

            mysqli_query(\Funzioni\getConnection(), $sql1);
            // mysqli_query(\Funzioni\getConnection(), $sql2);
            return true;
        } else {
            echo "DEBUG - Dati non validi - ELIMINA<br>";
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
        if( !empty($id_p) && $id_p ) {
            $sql = "SELECT * FROM umani WHERE id_p = '$id_p'";
            $res = mysqli_query(\Funzioni\getConnection(), $sql);
            return mysqli_fetch_assoc($res);
        } else {
            echo "DEBUG - Dati non validi -  - DETTAGLI<br>";
            return false;
        }
    }
