<?php


    # DATABASE PAGINE

    $pagine = array(
        0 => array(
            'titolo' => 'not found',
            'h1' => 'Pagina non trovata',
            'contenuto' => 'Pagina non trovata',
            'template' => 'index.html'
        ),
        1 => array(
            'titolo' => 'Menù del giorno',
            'h1' => 'Primi piatti',
            'contenuto' => 'scegli un piatto dal seguente menù: ',
            'template' => 'index.html',
        ),
        2 => array(
            'titolo' => 'Ingredienti',
            'h1' => 'Hai scelto un piatto!! Buon appetito!!!',
            'contenuto' => 'Gli ingredienti del piatto scelto sono: ' ,
            'template' => 'ingredienti.html',
        ),
    );

    # DATABASE PIATTI

    $menu_piatti = array(
        0 => array(
            "nome"=> "Spaghetti alla Carbonara",
            "ingredienti"=> "spaghetti, pecorino, uova, guanciale e pepe",
            "prezzo"=> "13€",            
        ),
        1 => array(
            "nome"=> "Spaghetti alla Puttanesca",
            "ingredienti"=> "spaghetti, capperi, olive, pomodoro, acciughe",
            "prezzo"=> "10€",            
        ),          
        2 => array(
            "nome"=> "Ravioli Burro e Noci",
            "ingredienti"=> "ravioli, burro, parmiggiano reggiano, noci, salvia",
            "prezzo"=> "14€",            
        ),
        3 => array(
            "nome"=> "Trofie al Pesto",
            "ingredienti"=> "trofie fresche, pesto di basilico e pinoli, formaggio parmiggiano, sale, pepe",
            "prezzo"=> "12€",            
        )
    );
