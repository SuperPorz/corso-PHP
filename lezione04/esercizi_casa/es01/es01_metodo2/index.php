<?php

    # PRIMA CONDIZIONE: Controlla se è stata selezionata una figura
    if (isset($_POST["figura"])) {
        
        # Reindirizzamento verso i files di calcolo
        $figura = $_POST["figura"];
        
        if ($figura == "triangolo") {
            include 'req_triangolo.php';
        } 
        elseif ($figura == 'rettangolo') {
            include 'req_rettangolo.php';
        } 
        elseif ($figura == 'cerchio') {
            include 'req_cerchio.php';
        }

        
    } else {
        # PARTE INDEX: Mostra il form di selezione figura
        
        # HTML - HEAD
        echo '<html>' . PHP_EOL;
        echo '<head>' . PHP_EOL;
        echo '<meta charset="UTF-8">' . PHP_EOL;
        echo '<title>Lezione 4</title>' . PHP_EOL;
        echo '</head>' . PHP_EOL;

        # HTML - BODY
        echo '<body>' . PHP_EOL;
        echo '<h1>Lezione 4 - esercizio calcolo aree</h1>' . PHP_EOL;
        echo '<p>Scegliere una delle figure nel menù:</p>' . PHP_EOL;
        echo '<form action="index.php" method="post" target="_self">' . PHP_EOL;  # Punta a se stesso
        echo '<label for="figura">' . PHP_EOL;
        echo '<select id="figura" name="figura">' . PHP_EOL;
        echo '<option value="triangolo">Triangolo</option>' . PHP_EOL;
        echo '<option value="rettangolo">Rettangolo</option>' . PHP_EOL;
        echo '<option value="cerchio">Cerchio</option>' . PHP_EOL;
        echo '</select>' . PHP_EOL;
        echo '<input type="submit" value="Invia">' . PHP_EOL;
        echo '</form>' . PHP_EOL;
        echo '</body>' . PHP_EOL;
        echo '</html>' . PHP_EOL;
    }

