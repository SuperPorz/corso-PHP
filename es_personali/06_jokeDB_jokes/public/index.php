<?php

    $title = 'Internet Joke Database';

    //avvia buffer
    ob_start();

    //includi file ma verrà mantenuto nel buffer del server
    include __DIR__ . '/../templates/home.html.php';

    //lettura del buffer e memorizzazione in una variabile
    $output = ob_get_clean();

    //includi template principale
    include __DIR__ . '/../templates/layout.html.php';