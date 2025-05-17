<?php

    # CICLO WHILE
    # fintanto che ID è <= 0, il programma non entra nel ciclo WHILE
    while( $_GET['id'] > 0 ) {
        echo $_GET['id'];
        echo '___';
        $_GET['id']--;
    }

    # CICLO DO-WHILE
    # il promma entra nel ciclo almeno una volta, poi verifica la condizione WHILE alla fine

    echo '<br>';

    do  {
        echo $_GET['id'];
        echo '<br>';
        $_GET['id']--;
    } while( $_GET['id'] > 0 );