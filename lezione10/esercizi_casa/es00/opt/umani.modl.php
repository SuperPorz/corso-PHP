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
            $sql2 = "INSERT INTO log_ (azione, id_p, nome_v, nome_n, cognome_v, cognome_n, numero_v, numero_n, data_az, ora_az) 
                     VALUES ('aggiungi', '$hash', '', '$nome', '', '$cognome', '', '$numero', '$curr_date', '$curr_hour')";
            mysqli_query(\Funzioni\getConnection(), $sql1);
            mysqli_query(\Funzioni\getConnection(), $sql2);
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

            // Prima recuperiamo i valori vecchi dalla tabella umani
            $sql_old = "SELECT nome, cognome, numero FROM umani WHERE id_p = '$id_p'";
            $res_old = mysqli_query(\Funzioni\getConnection(), $sql_old);
            $old_values = mysqli_fetch_assoc($res_old);
            
            if ($old_values) {
                $nome_vecchio = $old_values['nome'];
                $cognome_vecchio = $old_values['cognome'];
                $numero_vecchio = $old_values['numero'];
                
                // Ora eseguiamo l'UPDATE
                $sql1 = "UPDATE umani SET nome = '$nome', cognome = '$cognome', numero = '$numero' WHERE id_p = '$id_p'";
                
                // E inseriamo nel log con i valori recuperati
                $sql2 = "INSERT INTO log_ (azione, id_p, nome_v, nome_n, cognome_v, cognome_n, numero_v, numero_n, data_az, ora_az)
                        VALUES ('modifica', '$id_p', '$nome_vecchio', '$nome', '$cognome_vecchio', '$cognome', '$numero_vecchio', '$numero', '$curr_date', '$curr_hour')";
                
                mysqli_query(\Funzioni\getConnection(), $sql1);
                mysqli_query(\Funzioni\getConnection(), $sql2);
                return true;
            } else {
                echo "DEBUG - Persona non trovata - MODIFICA<br>";
                return false;
            }
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
            $sql2 = "INSERT INTO log_ (azione, id_p, nome_v, nome_n, cognome_v, cognome_n, numero_v, numero_n, data_az, ora_az)
                    VALUES (
                        'elimina',
                        '$id_p',
                        'val_eliminato',
                        'val_eliminato',
                        'val_eliminato',
                        'val_eliminato',
                        'val_eliminato',
                        'val_eliminato',
                        '$curr_date',
                        '$curr_hour'
                        )";

            mysqli_query(\Funzioni\getConnection(), $sql1);
            mysqli_query(\Funzioni\getConnection(), $sql2);
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
        if(!empty($id_p)) {
            $sql = "SELECT * FROM umani WHERE id_p = '$id_p'";
            $res = mysqli_query(\Funzioni\getConnection(), $sql);
            return mysqli_fetch_assoc($res);
        } else {
            echo "DEBUG - Dati non validi -  - DETTAGLI<br>";
            return false;
        }
    }
