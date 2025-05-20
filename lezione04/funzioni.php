<?php

    #definizione funzione:
    function ciaoMondo() {     #definizione funzione
        echo "ciao mondo! <br>";
    }

    #chiamata funzione:
    ciaoMondo();

    #chiamiamo la funzione in un ciclo (3 iterazioni)
    for ($i = 0; $i < 3; $i++) {
        ciaoMondo();
    };

    #funzione somma (void)
    function somma($a, $b) {
        echo "Somma " . ($a + $b) . '<br>';
    }
    somma(2, 3);

    #funzione con return (non void) + funzione concatenata
    function prodotto($a, $b) {
        return $a * $b;
    };

    echo "prodotto: " . prodotto(3, 7);
    echo '<br>';
    somma (5, prodotto(2, 3));

    
