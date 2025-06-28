<?php

    namespace Piloti;
    
    # questa funzione apre e legge il contenuto restituendolo se esiste (se non esiste, lista vuota)
    function lista (){

        if (!file_exists('piloti.db')) {
                return [];
            } 
        else {
                return unserialize(file_get_contents('piloti.db'));
            }
    }

    # funzione di scrittura dei dati nel database
    function scrittura($array){

        $x = fopen('piloti.db', 'w+');
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
    function aggiungi ($nome, $punteggio, $team) {

        $registro = lista();
        $id_persona = md5('registro'.microtime(true).rand(15, 5000));
        $registro[$id_persona] = 
            [
                'nome' => $nome,
                'punteggio' => $punteggio,
                'team' => $team,
            ];

        scrittura($registro);
        return true;
    }

    # funzione di modifica dati del database (usando poi la funzione di scrittura precedente)
    function modifica ($id_persona, $nome, $punteggio, $team) {

        $registro = lista();
        if (isset($registro[$id_persona])) 
        
            {
                $registro[$id_persona] = 
                    [
                        'nome' => $nome,
                        'punteggio' => $punteggio,
                        'team' => $team,
                    ];
                scrittura($registro);
                return true;
            }
        else 
            {
                return false;
            }
    }

    # funzione di eliminazione dati del database
    function elimina ($id_persona) {

        $registro = lista();

        if (isset($registro[$id_persona])) 
            {
                unset($registro[$id_persona]);
                scrittura($registro);
                return true;
            }
        else 
            { return false; } 
    }
                      