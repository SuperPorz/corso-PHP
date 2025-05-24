<?php

    if (!isset($azione_scelta)) {
        $azione_scelta = $_POST['scelta'] ?? '';  # ?? '' setta stringa vuota se !isset è TRUE
    }

    # Mostra il form SOLO se non ci sono ancora i dati per il calcolo
    if ($azione_scelta == 'cerchio' && !isset($_POST["raggio"])) {
        echo '<form action="output.php" method="post" target="_self">'. PHP_EOL;
        echo '<input type="hidden" name="scelta" value="cerchio">'. PHP_EOL;
        echo '<label for="raggio">Raggio</label>' .PHP_EOL;
        echo '<input type="number" id="raggio" name="raggio" max="999" min="0">' .PHP_EOL;
        echo '<input type="submit" value="Invia">' .PHP_EOL; 
        echo '</form>'. PHP_EOL; 
    }

     #area cerchio
    function areaCerchio ($raggio) {
        return ($raggio**2) * 3.14159;
    };

    