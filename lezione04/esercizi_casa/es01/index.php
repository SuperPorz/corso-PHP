<?php

    #HTML - HEAD
    echo '<html>' .PHP_EOL;
    echo '<head>'. PHP_EOL;
    echo '<meta charset="UTF-8">'. PHP_EOL;
    echo '<title>Lezione 4</title>'. PHP_EOL;
    echo  '</head>' . PHP_EOL;

    #HTML - BODY
    echo '<body>'. PHP_EOL;
    echo '<h1>Lezione 4 - esercizio calcolo aree</h1>'. PHP_EOL;
    echo '<p>Scegliere una delle figure nel menù:</p>'. PHP_EOL;
    echo '<form action="subindex.php" method="post" target="_blank">'. PHP_EOL;
    echo '<label for="figura">' .PHP_EOL;
    echo '<select id="figura" name="figura">' .PHP_EOL;
    echo '<option value="triangolo">Triangolo</option>' .PHP_EOL;
    echo '<option value="rettangolo">Rettangolo</option>' .PHP_EOL;
    echo '<option value="cerchio">Cerchio</option>' .PHP_EOL;
    echo '</select>' . PHP_EOL;
    echo '<input type="submit" value="Invia">' .PHP_EOL;
    echo '</form>'. PHP_EOL;
    echo '</body>'. PHP_EOL;
    echo '</html>'. PHP_EOL;


