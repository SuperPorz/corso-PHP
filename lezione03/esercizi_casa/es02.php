<?php

    $menu_primi = array(
        0=> array(
            "nome"=> "Spaghetti alla Carbonara",
            "ingredienti"=> "spaghetti, pecorino, uova, guanciale e pepe",
            "prezzo"=> "13€",            
        ),
        1=> array(
            "nome"=> "Spaghetti alla Puttanesca",
            "ingredienti"=> "spaghetti, capperi, olive, podoro, acciughe",
            "prezzo"=> "10€",            
        ),          
        2=> array(
            "nome"=> "Ravioli Burro e Noci",
            "ingredienti"=> "ravioli, burro, parmiggiano reggiano, noci, salvia",
            "prezzo"=> "14€",            
        ),
        3=> array(
            "nome"=> "Trofie al Pesto",
            "ingredienti"=> "trofie fresche, pesto di basilico e pinoli, formaggio parmiggiano, sale, pepe",
            "prezzo"=> "12€",            
        )
    );

    $menu_secondi = array(
        0=> array(
            "nome"=> "Pollo alle Mandorle",
            "ingredienti"=> "pollo, albumi, olio di semi arachide, acqua, fecola patate, sale, pepe bianco, mandorle pelate",
            "prezzo"=> "13€",            
        ),
        1=> array(
            "nome"=> "Vitello Tonnato",
            "ingredienti"=> "vitello, sedano, carote, cipolle, aglio, vino bianco, acqua, alloro, chiodi garofano, sale, pepe",
            "prezzo"=> "17€",            
        ),
        2=> array(
            "nome"=> "Polpette di Spinaci e Ricotta",
            "ingredienti"=> "spinaci, ricotta, grana padano, pan grattato, olio extravergine, aglio, sale, pepe nero",
            "prezzo"=> "15€",            
        ),
        3=> array(
            "nome"=> "Saltimbocca alla Romana",
            "ingredienti"=> "vitello, prosciutto crudo, salvia, vino bianco, pepe nero, farina00, olio extravergine, acqua",
            "prezzo"=> "15€",            
        ),
    );

   
    echo "Primo piatto scelto: " . '<strong>' .$menu_primi[$_POST["primo"]]['nome']. '</strong><br>';
    echo "Ingredienti usati: " . '<strong>' .$menu_primi[$_POST["primo"]]['ingredienti']. '</strong><br>';
    echo "Prezzo del piatto: " . '<strong>' .$menu_primi[$_POST["primo"]]['prezzo']. '</strong><br>';
    echo '<br>';
    echo "Secondo piatto scelto: " . '<strong>' .$menu_secondi[$_POST["secondo"]]['nome']. '</strong><br>'; 
    echo "Ingredienti usati: " . '<strong>' .$menu_secondi[$_POST["secondo"]]['ingredienti']. '</strong><br>';
    echo "Prezzo del piatto: " . '<strong>' .$menu_secondi[$_POST["secondo"]]['prezzo']. '</strong><br>';


    