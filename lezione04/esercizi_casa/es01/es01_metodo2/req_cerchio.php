<?php
    
    # CALCOLO CERCHIO

    require_once "libreria.php";

    if (!isset($figura)) {
        $figura = $_POST['figura'] ?? '';
    }

    # Mostra il form SOLO se non ci sono ancora i dati per il calcolo
    if (!isset($_POST["raggio"])) {
        echo '<form action="index.php" method="post" target="_self">'. PHP_EOL;
        echo '<input type="hidden" name="figura" value="cerchio">'. PHP_EOL;
        echo '<label for="raggio">Raggio</label>' .PHP_EOL;
        echo '<input type="number" id="raggio" name="raggio">' .PHP_EOL;
        echo '<input type="submit" value="Invia">' .PHP_EOL; 
        echo '</form>'. PHP_EOL; 
    }
    
    # Calcola e mostra il risultato
    if (isset($_POST["raggio"])) {
        $raggio = $_POST["raggio"];
        echo '<p>L\'area del cerchio è: </p>' .
            '<h1>' . areaCerchio($raggio) . '</h1>';
        echo '<br><a href="index.php">Calcola un\'altra figura</a>'; #torna indietro alla pagina iniziale per calcolare un'altra figura
    }

