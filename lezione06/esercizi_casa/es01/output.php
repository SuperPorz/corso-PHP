<?php

    include 'libreria.php';
    include 'database.php';

    
    $coppie_squadre = array (

        0 => $_POST['giocatore1'] . ' & ' . $_POST['giocatore2'] . ' VS ' .  $_POST['giocatore3'] . ' & ' .$_POST['giocatore4'],
        1 => $_POST['giocatore1'] . ' & ' . $_POST['giocatore3'] . ' VS ' .  $_POST['giocatore2'] . ' & ' .$_POST['giocatore4'],
        2 => $_POST['giocatore1'] . ' & ' . $_POST['giocatore4'] . ' VS ' .  $_POST['giocatore2'] . ' & ' .$_POST['giocatore3'],

    );   


    $uscita = render_1($pagine[2]["template"], $pagine[2]);

    $index_squadra = array_rand($coppie_squadre, 1);

    $uscita = str_replace('{{squadre}}', $coppie_squadre[$index_squadra], $uscita);
    
    echo $uscita;