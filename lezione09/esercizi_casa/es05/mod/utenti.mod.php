<?php

    namespace Utenti;
    
    # questa funzione apre e legge il contenuto restituendolo se esiste (se non esiste, lista vuota)
    function lista (){

        if (!file_exists('db/utenti.db')) {
                return [];
            } 
        else {
                return unserialize(file_get_contents('db/utenti.db'));
            }
    }

    # funzione di scrittura dei dati nel database
    function scrittura($array){

        $x = fopen('db/utenti.db', 'w+');
        if ($x == true) 
            {
                fwrite($x, serialize($array));
                fclose($x);
                return true;
            } 
        else 
            {
                return false;
            }
    }

    # funzione di aggiunta dati al file database (usando poi la funzione di scrittura precedente)
    function aggiungi ($nome, $cognome) {

        $database = lista();
        $id_persona = md5('registro'.microtime(true).rand(15, 5000));
        $database[$id_persona] = 
            [
                'nome' => $nome,
                'cognome' => $cognome,
            ];

        scrittura($database);
        return true;
    }

    # funzione di modifica dati del database (usando poi la funzione di scrittura precedente)
    function modifica ($id_persona, $nome, $cognome) {

        $database = lista();
        if (isset($database[$id_persona])) 
        
            {
                $database[$id_persona] = 
                    [
                        'nome' => $nome,
                        'cognome' => $cognome,
                    ];
                scrittura($database);
                return true;
            }
        else 
            {
                return false;
            }
    }

    # funzione di eliminazione dati del database
    function elimina ($id_persona) {

        $database = lista();

        if (isset($database[$id_persona])) 
            {
                unset($database[$id_persona]);
                scrittura($database);
                return true;
            }
        else 
            { return false; } 
    }
                      