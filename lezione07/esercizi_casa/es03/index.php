<?php

    #librerie necessarie SEMPRE: "database.php" & "render.php"
    require_once 'lib/database.php';
    require_once 'lib/funzioni.php';

    ############  PAGINA INDEX (1)  ############
    if ($_REQUEST['p'] == 'index') {

        #libreria specifica richiesta:
        include_once $pagine['index']['include']; 

        #render prima parte di 'index.html'
        $render_index = render($pagine['index']['template'], $pagine['index']['contenuto']);

        foreach ($menu_tendina as $key => $value) {

            $render_index = creaSelect($key, $value, $render_index);
        }

        #render parte finale di 'index.html'
        echo $render_index;


    ############  PAGINA CONFERMA (2)  ############
    } elseif ($_REQUEST['p'] == 'conferma') {
    
        #libreria specifica richiesta:
        require_once $pagine['conferma']['include'];

        #render prima parte di 'conferma.html'
        $render_pagina2 = render($pagine['conferma']['template'], $pagine['conferma']['contenuto']);

            foreach ($composizione_menu as $key => $value) {
                
                foreach ($value as $k => $v) {

                    $render_pagina2 = str_replace($k, $v, $render_pagina2);
                }
            }

        #sostituzione PREZZO TOTALE con risultato somma delle portate
        $risultato = somma ($menu_primi[$_POST['primo']]['prezzo'], $menu_secondi[$_POST['secondo']]['prezzo'], $menu_dolci[$_POST['dolce']]['prezzo']);
        $render_pagina2 = str_replace('{{prezzo_tot}}', $risultato, $render_pagina2);

        #render parte finale di 'conferma.html'
        echo $render_pagina2;

    ############  PAGINA RINGRAZIAMENTI (3)  ############
    } elseif ($_REQUEST['p'] == 'ringraziamenti') {

        echo render($pagine['ringraziamenti']['template'], $pagine['ringraziamenti']['contenuto']);
    }
