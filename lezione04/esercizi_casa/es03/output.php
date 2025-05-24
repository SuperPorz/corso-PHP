<?php

    $azione_scelta = $_POST['scelta'] ?? '';

    if ($azione_scelta == "triangolo") {
            include 'lib_triangolo.php';
        } 
        elseif ($azione_scelta == 'rettangolo') {
            include 'lib_rettangolo.php';
        } 
        elseif ($azione_scelta == 'cerchio') {
            include 'lib_cerchio.php';
        }
        elseif ($azione_scelta == 'MCM') {
            include 'lib_MCM.php';
        }
    
    # Calcola e mostra il risultato
    if (isset($_POST["base"]) && isset($_POST["altezza"])) {
        $base = $_POST["base"];
        $altezza = $_POST["altezza"];
        echo '<p>L\'area del triangolo è: </p>' . 
            '<h1>' . areaTriangolo($base, $altezza) . '</h1>';
        echo '<br><a href="index.php">Scegli un altro calcolo cliccando questo link</a>'; #torna indietro alla pagina iniziale per calcolare un'altra figura
    }

    # Calcola e mostra il risultato se è stato scelto RETTANGOLO
    if (isset($_POST["lato1"]) && isset($_POST["lato2"])) {
        $lato1 = $_POST["lato1"];
        $lato2 = $_POST["lato2"];
        echo '<p>L\'area del rettangolo è: </p>' .
            '<h1>' . areaRettangolo($lato1, $lato2) . '</h1>';
        echo '<br><a href="index.php">Scegli un altro calcolo cliccando questo link</a>'; #torna indietro alla pagina iniziale per calcolare un'altra figura
    }

    # Calcola e mostra il risultato se è stato scelto CERCHIO
    if (isset($_POST["raggio"])) {
        $raggio = $_POST["raggio"];
        echo '<p>L\'area della figura è: </p>' . '<h1>' . areaCerchio ($raggio) . '</h1>';
        echo '<br><a href="index.php">Scegli un altro calcolo cliccando questo link</a>'; #torna indietro alla pagina iniziale per calcolare un'altra figura      
    }

    # Calcola e mostra il risultato se è stato scelto MCM
    if (isset($_POST["numero1"]) && isset($_POST["numero2"])) {
        $a = $_POST["numero1"];
        $b = $_POST["numero2"];
        echo '<p>Il Minimo Comune Multiplo di ' . '<strong>' . $a . '</strong>' . ' e '. '<strong>' . $b . '</strong>' .' risulta: </p>';
        echo '<h1>' . mcm($a, $b) . '</h1>';
        echo '<br><a href="index.php">Scegli un altro calcolo cliccando questo link</a>'; #torna indietro alla pagina iniziale per calcolare un'altra figura
    }



