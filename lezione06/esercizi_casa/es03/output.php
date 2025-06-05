<?php

    require 'lib/render.php';
    require 'lib/calcoli.php';

    $render_pagina = render($pagine[4]['template'], $pagine[4]);

    switch (true) {
        case ((array_key_exists('lato1', $_POST)) && $_POST['calcolo'] == 0): #caso rettangolo + area

            $calcolo = area($_POST['lato1'], $_POST['lato2']);
            break;

        case ((array_key_exists('lato1', $_POST)) && $_POST['calcolo'] == 1): #caso rettangolo + perimetro

            $calcolo = perimetro_rettangolo($_POST['lato1'], $_POST['lato2']);
            break;

        case ((array_key_exists('base', $_POST)) && $_POST['calcolo'] == 0): #caso triangolo + area

            $calcolo = area($_POST['base'], $_POST['altezza']);
            break;

        case ((array_key_exists('base', $_POST)) && $_POST['calcolo'] == 1): #caso triangolo + perimetro

            $calcolo = perimetro_triangolo($_POST['base'], $_POST['altezza']);
            break;

        case ((array_key_exists('raggio', $_POST)) && $_POST['calcolo'] == 0): #caso cerchio + area

            $calcolo = area($_POST['raggio'], 0);
            break;

        case ((array_key_exists('raggio', $_POST)) && $_POST['calcolo'] == 1): #caso cerchio + perimetro

            $calcolo = perimetro_cerchio($_POST['raggio']);
            break;      

    }    

    $render_pagina = str_replace('{{risultato}}', $calcolo, $render_pagina);

    echo $render_pagina;