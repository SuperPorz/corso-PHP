<?php

    namespace Registro;
    
    # questa funzione apre e legge il contenuto restituendolo se esiste (se non esiste, lista vuota)
    function lista (){

        if (!file_exists('registro.db')) {
                return [];
            } 
        else {
                return unserialize(file_get_contents('registro.db'));
            }
    }

    # funzione di scrittura dei dati nel database
    function scrittura($array){

        $x = fopen('registro.db', 'w+');
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
    function aggiungi ($nome, $telefono, $num_camera) {

        $registro = lista();
        $id_persona = md5('registro'.microtime(true).rand(15, 5000));
        $registro[$id_persona] = 
            [
                'nome' => $nome,
                'telefono' => $telefono,
                'camera' => $num_camera
            ];

        scrittura($registro);
        return true;
    }

    # funzione di modifica dati del database (usando poi la funzione di scrittura precedente)
    function modifica ($id_persona, $nome, $telefono, $num_camera) {

        $registro = lista();
        if (isset($registro[$id_persona])) 
        
            {
                $registro[$id_persona] = 
                    [
                        'nome' => $nome,
                        'telefono' => $telefono,
                        'camera' => $num_camera
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
            {
                return false;
            } 
    }
