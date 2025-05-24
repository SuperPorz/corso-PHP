<?php

    # CALCOLO TRIANGOLO

    require_once "libreria.php";

    if (!isset($figura)) {
        $figura = $_POST['figura'] ?? '';
    }

    // Mostra il form SOLO se non ci sono ancora i dati per il calcolo
    if ($figura == "triangolo" && !isset($_POST["base"]) && !isset($_POST["altezza"])) {
        echo '<form action="index.php" method="post" target="_self">'. PHP_EOL;
        echo '<input type="hidden" name="figura" value="triangolo">'. PHP_EOL;
        echo '<label for="base">Base</label>' .PHP_EOL;
        echo '<input type="number" id="base" name="base">' .PHP_EOL;
        echo '<label for="altezza">Altezza</label>' .PHP_EOL;
        echo '<input type="number" id="altezza" name="altezza">' .PHP_EOL;
        echo '<input type="submit" value="Invia">' .PHP_EOL;   
        echo '</form>'. PHP_EOL; 
    } 

    // Calcola e mostra il risultato
    if (isset($_POST["base"]) && isset($_POST["altezza"])) {
        $base = $_POST["base"];
        $altezza = $_POST["altezza"];
        echo '<p>L\'area del triangolo è: </p>' . 
            '<h1>' . areaTriangolo($base, $altezza) . '</h1>';
        echo '<br><a href="index.php">Calcola un\'altra figura</a>'; #torna indietro alla pagina iniziale per calcolare un'altra figura
    };

