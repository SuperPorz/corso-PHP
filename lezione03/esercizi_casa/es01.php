<?php

    $stanze = array(
        0=> array(
            "occupante"=> "Mario",
            "telefono"=> "0514050980",
        ),
        1=> array(
            "occupante"=> "Sandra",
            "telefono"=> "0514051652",
        ),
        2=> array(
            "occupante"=> "Giovanna",
            "telefono"=> "0516709814",
        ),
        3=> array(
            "occupante"=> "Consuelo",
            "telefono"=> "0515033174",
        ),
        4=> array(
            "occupante"=> "Davide",
            "telefono"=> "0515448120",
        ),
        5=> array(
            "occupante"=> "Carmelo",
            "telefono"=> "0513567428",
        ),
    );

    if (isset($_POST["id"])) {
        echo "La stanza " . '<strong>' .$_POST["id"] . '</strong>' . " è occupata da " . '<strong>' .$stanze[$_POST["id"]]['occupante'] . '</strong>' .
            " Il suo numero di telefono è: " . '<strong>' .$stanze[$_POST['id']]['telefono'] . '</strong>'; 
    } else 
        foreach ($stanze as $chiavi => $valori) {
            echo 'Nella stanza '. '<strong>' . $chiavi .'</strong>' .
                ' è presente: '. '<strong>' .$valori['occupante'] . '</strong>' . 
                ' ed il suo numero è: ' . '<strong>' .$valori['telefono'] . '</strong>' . '<br>';
        };