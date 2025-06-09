<?php

    $pagine = array(
        'index' => array(
            'contenuto' => array(
                '{{titolo}}' => 'INDEX',
                '{{h1}}' => 'Benvenuto! Scegli un PRIMO, un SECONDO e un DOLCE per comporre il tuo MENU!',
            ),
            'template' => 'tpl/index.html',
            'include' => 'lib/nomi_piatti.php'
        ),

        'conferma' => array(
            'contenuto' => array(
                '{{titolo}}' => 'CONFERMA MENU',
                '{{h1}}' => 'Ecco il menu che hai scelto! Conferma per inviare l\'ordine',       
            ),
            'template' => 'tpl/pagina.html',
            'include' => 'lib/composizione.php',
        ),

        'ringraziamenti' => array(
            'contenuto' => array(
                '{{titolo}}' => 'RINGRAZIAMENTI',
                '{{h1}}' => 'Ottimo! Ordine Inserito. Grazie per averci scelto!',
            ),
            'template' => 'tpl/ringraziamenti.html',
        ),

    );

    $menu_primi = array(
        0 => array(
            "nome"=> "Spaghetti alla Carbonara",
            "ingredienti"=> "spaghetti, pecorino, uova, guanciale e pepe",
            "prezzo"=> 13,
            "img"=> 'pic/spaghetti_carbonara.webp',            
        ),
        1 => array(
            "nome"=> "Spaghetti alla Puttanesca",
            "ingredienti"=> "spaghetti, capperi, olive, podoro, acciughe",
            "prezzo"=> 10,
            "img"=> 'pic/spaghetti_puttanesca.webp',               
        ),          
        2 => array(
            "nome"=> "Ravioli Burro e Noci",
            "ingredienti"=> "ravioli, burro, parmiggiano reggiano, noci, salvia",
            "prezzo"=> 14,
            "img"=> 'pic/ravioli_noci.jpg',               
        ),
        3 => array(
            "nome"=> "Trofie al Pesto",
            "ingredienti"=> "trofie fresche, pesto di basilico e pinoli, formaggio parmiggiano, sale, pepe",
            "prezzo"=> 12,
            "img"=> 'pic/trofie_pesto.jpg',               
        )
    );

    $menu_secondi = array(
        0 => array(
            "nome"=> "Pollo alle Mandorle",
            "ingredienti"=> "pollo, albumi, olio di semi arachide, acqua, fecola patate, sale, pepe bianco, mandorle pelate",
            "prezzo"=> 13,
            "img"=> 'pic/pollo_mandorle.avif',
                        
        ),
        1 => array(
            "nome"=> "Vitello Tonnato",
            "ingredienti"=> "vitello, sedano, carote, cipolle, aglio, vino bianco, acqua, alloro, chiodi garofano, sale, pepe",
            "prezzo"=> 17,
            "img"=> 'pic/vitello_tonnato.avif',            
        ),
        2 => array(
            "nome"=> "Polpette di Spinaci e Ricotta",
            "ingredienti"=> "spinaci, ricotta, grana padano, pan grattato, olio extravergine, aglio, sale, pepe nero",
            "prezzo"=> 15,
            "img"=> 'pic/polpette_spinaci.avif',            
        ),
        3 => array(
            "nome"=> "Saltimbocca alla Romana",
            "ingredienti"=> "vitello, prosciutto crudo, salvia, vino bianco, pepe nero, farina00, olio extravergine, acqua",
            "prezzo"=> 15,
            "img"=> 'pic/saltimbocca_romana.avif',            
        ),
    );


    $menu_dolci = array(
        0 => array(
            "nome"=> "Tiramisù",
            "ingredienti"=> "mascarpone, savoiardi, caffè, uova, zucchero",
            "prezzo"=> 7,
            "img"=> 'pic/tiramisu.avif',            
        ),
        1 => array(
            "nome"=> "Cheesecake al limone",
            "ingredienti"=> "biscotti, burro, ricotta, formaggio fresco, limone, zucchero a velo, panna fresca, gelatina",
            "prezzo"=> 9,
            "img"=> 'pic/cheesecake_limone.avif',            
        ),
        2 => array(
            "nome"=> "Torta di mele",
            "ingredienti"=> "mele, zucchero, farina 00, burro, latte intero, uova, limoni, lievito, cannella, zucchero a velo",
            "prezzo"=> 8, 
            "img"=> 'pic/torta_mele.avif',           
        ),
        3 => array(
            "nome"=> "Panna cotta ai lamponi",
            "ingredienti"=> "lamponi, bacello vaniglia, zucchero a velo, panna fresca, gelatina",
            "prezzo"=> 7,
            "img"=> 'pic/pannacotta_lamponi.jpg',            
        ),
    );
    

