<?php

    $output = '';
    for ($count = 1; $count <= 10; $count++) {
        $output .= $count . ' ';
    }

    include __DIR__ . '/../templates/count.html.php';