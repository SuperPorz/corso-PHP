<?php

    if ($_POST['bottone'] == 'Invia') {

        $dado1 = rand(1,6);
        $dado2 = rand(1,6);

        $messaggio = '<p> Hai ottenuto un ' . $dado1 . ' e un ' . $dado2 . '</p>';

        if ($dado1 == 6 && $dado2 == 6) {
            $messaggio = '<h2> Hai Vinto!!! Doppio 6!!!</h2>';
        }
        else {
            $messaggio =  '<p> Peccato! Hai perso. Riprova! </p>';
        }
    }

    $render = file_get_contents('tpl/index.html');
    $render = str_replace('{{testo}}', $messaggio, $render);
    echo $render;
