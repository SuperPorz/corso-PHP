<?php

    namespace Team;
    
    # questa funzione apre e legge il contenuto restituendolo se esiste (se non esiste, lista vuota)
    function lista (){

        if (!file_exists('team.db')) {
                return [];
            } 
        else {
                return unserialize(file_get_contents('team.db'));
            }
    }

    # funzione di scrittura dei dati nel database
    function scrittura($array){

        $x = fopen('team.db', 'w+');
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
    function aggiungi ($nome) {

        $elenco_team = lista();
        $id_team = md5('elenco'.microtime(true).rand(15, 5000));
        $elenco_team[$id_team] = 
            [
                'nome_team' => $nome,
            ];

        scrittura($elenco_team);
        return true;
    }

    # funzione di modifica dati del database (usando poi la funzione di scrittura precedente)
    function modifica ($id_team, $nome) {

        $elenco_team = lista();
        if (isset($elenco_team[$id_team])) 
        
            {
                $elenco_team[$id_team] = 
                    [
                        'nome_team' => $nome,
                    ];
                scrittura($elenco_team);
                return true;
            }
        else 
            {
                return false;
            }
    }

    # funzione di eliminazione dati del database
    function elimina ($id_team) {

        $elenco_team = lista();

        if (isset($elenco_team[$id_team])) 
            {
                unset($elenco_team[$id_team]);
                scrittura($elenco_team);
                return true;
            }
        else 
            { return false; } 
    }                   