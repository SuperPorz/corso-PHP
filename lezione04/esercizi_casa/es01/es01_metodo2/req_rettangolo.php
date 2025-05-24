<?php

    # CALCOLI RETTANGOLO

    require_once "libreria.php";

    if (!isset($figura)) {
        $figura = $_POST['figura'] ?? '';
    }

    # Mostra il form SOLO se non ci sono ancora i dati per il calcolo
    if ($figura == 'rettangolo' && !isset($_POST["lato1"]) && !isset($_POST["lato2"])) {
        echo '<form action="index.php" method="post" target="_self">'. PHP_EOL;
        echo '<input type="hidden" name="figura" value="rettangolo">'. PHP_EOL;
        echo '<label for="lato1">Lato 1</label>' .PHP_EOL;
        echo '<input type="number" id="lato1" name="lato1">' .PHP_EOL;
        echo '<label for="lato2">Lato 2</label>' .PHP_EOL;
        echo '<input type="number" id="lato2" name="lato2">' .PHP_EOL;
        echo '<input type="submit" value="Invia">' .PHP_EOL;
        echo '</form>'. PHP_EOL;      
    }

    # Calcola e mostra il risultato
    if (isset($_POST["lato1"]) && isset($_POST["lato2"])) {
        $lato1 = $_POST["lato1"];
        $lato2 = $_POST["lato2"];
        echo '<p>L\'area del rettangolo è: </p>' .
            '<h1>' . areaRettangolo($lato1, $lato2) . '</h1>';
        echo '<br><a href="index.php">Calcola un\'altra figura</a>'; #torna indietro alla pagina iniziale per calcolare un'altra figura
    }

