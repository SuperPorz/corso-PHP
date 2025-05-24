<?php

    #HTML - HEAD
    echo '<html>' .PHP_EOL;
    echo '<head>'. PHP_EOL;
    echo '<meta charset="UTF-8">'. PHP_EOL;
    echo '<title>Lezione 4</title>'. PHP_EOL;
    echo  '</head>' . PHP_EOL;


    #HTML - BODY
    echo '<body>'. PHP_EOL;
    echo '<h2>Lezione 4 - esercizio per casa 2</h2>'. PHP_EOL;
    echo 'Il Minimo Comune Multiplo tra '. '<strong>' .$a . ' e ' . $b . '</strong>' ." risulta: <br>" .PHP_EOL;
    echo '<h1>' . mcm($a, $b) . '</h1'. PHP_EOL;
    echo '</body>'. PHP_EOL;
    echo '</html>'. PHP_EOL;
