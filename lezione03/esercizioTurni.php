<?php

    // array associativo che associa giorno settimana => addetto pulizie
    // se nessun giorno dato -> stampa tutti i giorni della settimana con relativo addetto
    // 0 a 6 -> stampa l'addetto di quel giorno

    $turni = array(
        0=> array(
            "giorno"=> "lunedi",
            "addetto"=> "gennaro",
        ),
        1=> array(
            "giorno"=> "martedi",
            "addetto"=> "claudia",
        ),
        2=> array(
            "giorno"=> "mercoledi",
            "addetto"=> "amelia",
        ),
        3=> array(
            "giorno"=> "giovedi",
            "addetto"=> "davide",
        ),
        4=> array(
            "giorno"=> "venerdi",
            "addetto"=> "manuela",
        ),
        5=> array(
            "giorno"=> "sabato",
            "addetto"=> "landini",
        ),
        6=> array(
            "giorno"=> "domenica",
            "addetto"=> "conte",
        ),
    );

    if (isset($_GET["giorno"])) {                //qui controlliamo che la $_GET è settata oppure no
        echo $turni[$_GET["giorno"]]["giorno"]
            . " è di turno: "
            . $turni[$_GET["giorno"]]['addetto'];
    } else {
        foreach ($turni as $turno) {
            echo $turno["giorno"]
                . ' è di turno: '
                . $turno["addetto"]
                . '<br>';
        };
    };
