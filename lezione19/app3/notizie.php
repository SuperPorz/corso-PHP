<?php

    # INCLUDES
    include './src/DatabaseConnection.php';
    include './src/DatabaseTable.php';

    # ISTANZE
    $tab_notizie = new DatabaseTable($pdo, 'notizie', 'idn');

    # VETTORE DATI
    $data = $tab_notizie->find_all();

    # FUNZIONI HEADER (gli header precedono il contenuto)
    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json; charset=utf-8");

    # ECHO DELLA RISPOSTA
    echo json_encode($data);