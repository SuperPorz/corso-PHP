<?php

    echo '<table border>';

    for ($i = 0; $i < 3; $i++) {
        echo '<tr>';
        for ($j = 0; $j < 3; $j++) {
            echo '<td>';
            echo $i . ' ' . $j;
            echo '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';