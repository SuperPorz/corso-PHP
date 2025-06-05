<?php

  
    $dati_ricevuti = array(

        "nome" => $_POST["nome"],
        "cognome" => $_POST["cognome"],
    );

    if (isset($_POST["nome"]) && ($_POST["cognome"])) {

        $contenuto = file_get_contents("dati.html");

        foreach($dati_ricevuti as $key => $value) {
            $contenuto = str_replace('{{' . $key . '}}',$value, $contenuto);
        };

        echo $contenuto;
    } else {
        echo 'nessun dato inviato';
    };
    
    

    