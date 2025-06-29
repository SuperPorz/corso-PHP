<?php

    namespace Campi;
    
    # questa funzione apre e legge il contenuto restituendolo se esiste (se non esiste, lista vuota)
    function lista (){

        if (!file_exists('db/campi.db')) {
                return [];
            } 
        else {
                return unserialize(file_get_contents('db/campi.db'));
            }
    }

    # funzione di scrittura dei dati nel database
    function scrittura($array){

        $x = fopen('db/campi.db', 'w+');
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
    function aggiungi ($nome_campo) {

        $database = lista();
        $id_campo = md5('registro'.microtime(true).rand(15, 5000));
        $database[$id_campo] = 
            [
                'nome_campo' => $nome_campo
            ];

        scrittura($database);
        return true;
    }

    # funzione di modifica dati del database (usando poi la funzione di scrittura precedente)
    function modifica ($id_campo, $nome_campo) {

        $database = lista();
        if (isset($database[$id_campo])) 
        
            {
                $database[$id_campo] = 
                    [
                        'nome_campo' => $nome_campo
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
    function elimina ($id_campo) {

        $database = lista();

        if (isset($database[$id_campo])) 
            {
                unset($database[$id_campo]);
                scrittura($database);
                return true;
            }
        else 
            { return false; } 
    }                   