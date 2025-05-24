<?php

    if (!isset($azione_scelta)) {
        $azione_scelta = $_POST['scelta'] ?? '';  # ?? '' setta stringa vuota se !isset è TRUE
    }

    # Mostra il form SOLO se non ci sono ancora i dati per il calcolo
    if ($azione_scelta == 'rettangolo' && !isset($_POST["lato1"]) && !isset($_POST["lato2"])) {
        echo '<form action="output.php" method="post" target="_self">'. PHP_EOL;
        echo '<input type="hidden" name="scelta" value="rettangolo">'. PHP_EOL;
        echo '<label for="lato1">Lato 1</label>' .PHP_EOL;
        echo '<input type="number" id="lato1" name="lato1" max="999" min="0">' .PHP_EOL;
        echo '<label for="lato2">Lato 2</label>' .PHP_EOL;
        echo '<input type="number" id="lato2" name="lato2" max="999" min="0">' .PHP_EOL;
        echo '<input type="submit" value="Invia">' .PHP_EOL;
        echo '</form>'. PHP_EOL;      
    }

    #area rettangolo
    function areaRettangolo ($lato1, $lato2 ) {
        return $lato1 * $lato2;
    };