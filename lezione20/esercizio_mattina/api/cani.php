<?php

    // includes
    include 'DatabaseConnection.php';
    include 'DatabaseTable.php';

    //istanza tabella cani
    $tab_cani = new DatabaseTable($pdo, 'cani', 'id');

    // header
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");

    // catturo il metodo HTTP usato
    $method = $_SERVER['REQUEST_METHOD'];
    $message = [];

    // switch in base al metodo
    switch($method) {
        case 'GET':

            // se c'è un id, recupera il cane specifico
            if (isset($_GET['id'])) {
                $message = $tab_cani->find_by_id($_GET['id']);
                
                // Se non trova il cane
                if (!$message) {
                    $message = ["error" => "Cane non trovato"];
                }
            }
            else {
                // Altrimenti recupera tutti i cani
                $message = $tab_cani->find_all();
            }

            break;

        case 'POST':

            // Riceve i dati dal body della richiesta POST
            $input = json_decode(file_get_contents('php://input'), true);
            $dati = [
                'nome' => $input['nome'],
                'data_n' => $input['data_n']
            ];
            $tab_cani->save($dati);
            $message = ["success" => "Cane inserito correttamente"];

            break;

        case 'PUT':

            // Riceve i dati dal body della richiesta PUT
            $input = json_decode(file_get_contents('php://input'), true);
            $dati = [
                'id' => $_GET['id'] ?? $input['id'],
                'nome' => $input['nome'],
                'data_n' => $input['data_n']
            ];
            $tab_cani->save($dati);
            $message = ["success" => "Cane aggiornato correttamente"];

            break;

        case 'DELETE':

            if (isset($_GET['id'])) {
                $tab_cani->delete($_GET['id']);
                $message = ["success" => "Cane eliminato correttamente"];
            } else {
                $message = ["error" => "ID mancante"];
            }

            break;

        default:

            // metodo non supportato
            die(json_encode(["error" => "Metodo non supportato"]));
            break;

    }

    echo json_encode($message);