<?php

    $io = array(

        "nome" => "Michelangelo",
        "cognome"=> "Stega",
        "residenza"=> "Valsamoggia",
        "telefono"=> "3273520909",
    ) ;


    $contenuto = file_get_contents("io.html") ;

    foreach ($io as $key => $value) {
        $contenuto = str_replace('{{' . $key . '}}',"$value", $contenuto);
    };

    echo $contenuto;



     