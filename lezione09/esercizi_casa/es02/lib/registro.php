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
    function aggiungi ($nome, $telefono, $num_camera, $arrivo, $partenza) {

        $registro = lista();
        $id_persona = md5('registro'.microtime(true).rand(15, 5000));
        $registro[$id_persona] = 
            [
                'nome' => $nome,
                'telefono' => $telefono,
                'camera' => $num_camera,
                'arrivo' => $arrivo,
                'partenza' => $partenza,
            ];

        scrittura($registro);
        return true;
    }

    # funzione di modifica dati del database (usando poi la funzione di scrittura precedente)
    function modifica ($id_persona, $nome, $telefono, $num_camera, $arrivo, $partenza) {

        $registro = lista();
        if (isset($registro[$id_persona])) 
        
            {
                $registro[$id_persona] = 
                    [
                        'nome' => $nome,
                        'telefono' => $telefono,
                        'camera' => $num_camera,
                        'arrivo' => $arrivo,
                        'partenza' => $partenza,
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

    function overbooking ($camera, $arrivo, $partenza, $id_persona=''){

        $registro = lista();

        foreach ($registro as $k => $value) {    
            switch (true) {
                case ($value['camera'] == $camera && $id_persona == $registro[$k]): #se n°camera inserito esista già e id persone diverse, allora check delle date
                    switch (true) 
                        {
                            case (date($registro[$k]['arrivo']) <= date($arrivo) && date($arrivo) <= date($registro[$k]['partenza'])):
                                return false;
                            case (date($arrivo) <= date($registro[$k]['arrivo']) && date($registro[$k]['arrivo']) <= date($partenza)):
                                return false;
                            case (date($registro[$k]['arrivo']) <= date($arrivo) && date($registro[$k]['partenza']) >= date($partenza)):
                                return false;
                            case (date($arrivo) <= date($registro[$k]['arrivo']) && date($partenza) >= date($registro[$k]['partenza']));
                                return false;
                            default:
                                echo "Camera disponibile! Prenotazione confermata";
                                return true;
                        }
                case ($value['camera'] == $camera && $id_persona != $registro[$k]): #se n°camera inserito esista già ma id persone uguali, aprocedo direttamente a modifica
                    switch (true) 
                        {
                            case (date($registro[$k]['arrivo']) <= date($arrivo) && date($arrivo) <= date($registro[$k]['partenza'])):
                                return false;
                            case (date($arrivo) <= date($registro[$k]['arrivo']) && date($registro[$k]['arrivo']) <= date($partenza)):
                                return false;
                            case (date($registro[$k]['arrivo']) <= date($arrivo) && date($registro[$k]['partenza']) >= date($partenza)):
                                return false;
                            case (date($arrivo) <= date($registro[$k]['arrivo']) && date($partenza) >= date($registro[$k]['partenza']));
                                return false;
                            default:
                                echo "Modifica avvenuta! Prenotazione confermata";
                                return true;
                        } 
                default: 
                    echo "Camera disponibile! Prenotazione confermata";
                    return true;
            }
        } 
    }                       