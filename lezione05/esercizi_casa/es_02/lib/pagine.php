<?php

    include_once 'funzioni.php';


    # DATABASE PAGINE 

    $pagine = array(
        0 => array(
            'titolo' => 'not found',
            'h1' => 'Pagina non trovata',
            'contenuto' => 'Pagina non trovata',
            'template' => 'templ/index.html'
        ),
        1 => array(
            'titolo' => 'Calcolo distanza - INPUT',
            'h1' => 'Inserimento dati',
            'contenuto' => 'Inserisci le coordinate dei numeri di cui vuoi calcolare la distanza euclidea: ',
            'template' => 'templ/index.html',
        ),
        2 => array(
            'titolo' => 'Calcolo distanza - OUTPUT',
            'h1' => 'Distanza tra i punti scelti calcolata! Ecco il risultato: ',
            'contenuto' => '???',
            'template' => '../templ/calcolo.html',
        ),
    );


    # RENDERIZZAZIONE PAGINE

    #se POST non è vuoto (cioè TRUE quando il form viene inviato), renderizziamo la pagina RISULTATO
    if(!empty($_POST)) {

        # Pagina dal database
        $pagina = $pagine[2];

        # Risultato calcolo funzione 
        $risultato = distanza_punti($_POST);

        # Aggiungi il risultato al contenuto della pagina
        $pagina['contenuto'] = $risultato;

        # Render pagina con funzione da libreria 
        $output2 = render($pagina['template'], $pagina);
        echo $output2;
        exit;

    #se POST è vuoto (cioè a inizio pagina), renderizziamo la pagina INDEX
    } else {

        # PAGINA INDEX
        $pagina = $pagine[1];
        $output = render($pagina['template'], $pagina); 
        echo $output;
    }