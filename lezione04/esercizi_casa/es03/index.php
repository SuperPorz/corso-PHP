<?php

    # PRIMA PARTE: Controlla se è stata selezionata una figura (di default non sarà settato nulla, quindi si skippa direttamente alla seconda)

    if (isset($_POST["scelta"])) {
        
        # Reindirizzamento verso i files di calcolo
        $azione_scelta = $_POST["scelta"];
        
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

    } else {     
        
    # SECONDA PARTE: Mostra form selezione figura, poi reindirizza verso index.php stesso attivando prima parte (che rimanda alle varie librerie)
    
        echo '<!DOCTYPE html>'. PHP_EOL;

        # HTML - HEAD
        echo '<html lang="it">' . PHP_EOL;
        echo '<head>' . PHP_EOL;
        echo '<meta charset="UTF-8">' . PHP_EOL;
        echo '<title>Lezione 4</title>' . PHP_EOL;
        echo '</head>' . PHP_EOL;

        # HTML - BODY
        echo '<body>' . PHP_EOL;
        echo '<h2>Lezione 4 - esercizio 2 - Scelta calcolo</h2>' . PHP_EOL;
        echo '<p>Scegliere una delle opzioni seguenti:</p>' . PHP_EOL;
        echo '<form action="index.php" method="post" target="_self">' . PHP_EOL;  # Punta a se stesso
        echo '<label for="scelta">' . PHP_EOL;
        echo '<select id="scelta" name="scelta">' . PHP_EOL;
        echo '<option value="triangolo">Triangolo</option>' . PHP_EOL;
        echo '<option value="rettangolo">Rettangolo</option>' . PHP_EOL;
        echo '<option value="cerchio">Cerchio</option>' . PHP_EOL;
        echo '<option value="MCM">MCM</option>' . PHP_EOL;
        echo '</select>' . PHP_EOL;
        echo '<input type="submit" value="Invia">' . PHP_EOL;
        echo '</form>' . PHP_EOL;
        echo '</body>' . PHP_EOL;
        echo '</html>' . PHP_EOL;
    }

