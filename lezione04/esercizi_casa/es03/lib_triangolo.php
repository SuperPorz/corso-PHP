<?php

    if (!isset($azione_scelta)) {
        $azione_scelta = $_POST['scelta'] ?? '';  # ?? '' setta stringa vuota se !isset è TRUE
    }

    # Mostra il form SOLO se non ci sono ancora i dati per il calcolo
    if ($azione_scelta == "triangolo" && !isset($_POST["base"]) && !isset($_POST["altezza"])) {
        echo '<form action="output.php" method="post" target="_self">'. PHP_EOL;
        echo '<input type="hidden" name="scelta" value="triangolo">'. PHP_EOL;
        echo '<label for="base">Base</label>' .PHP_EOL;
        echo '<input type="number" id="base" name="base" max="999" min="0">' .PHP_EOL;
        echo '<label for="altezza">Altezza</label>' .PHP_EOL;
        echo '<input type="number" id="altezza" name="altezza" max="999" min="0">' .PHP_EOL;
        echo '<input type="submit" value="Invia">' .PHP_EOL;   
        echo '</form>'. PHP_EOL; 
    } 

    function areaTriangolo ($base, $altezza ) {
        return ($base * $altezza) / 2;
    };