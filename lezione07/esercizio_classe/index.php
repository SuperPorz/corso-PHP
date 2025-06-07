<?php

    require 'lib/pagine.php';
    require 'lib/funzioni.php';

    echo render(
        $pagine[$_REQUEST['p']]['template'],
        $pagine[$_REQUEST['p']]['contenuto']
    );