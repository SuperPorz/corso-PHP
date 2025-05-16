<?php

    $citta = array(
        "pechino" => "cina",
        "kinshasa"=> "congo",
        "il cairo"=> "egitto",
        "tokyo"   => "giappone",
        "dacca"=> "bangladesh",
        "mosca"=> "russia",
        "giacarta"=> "indonesia",
        "seul"=> "corea del sud",
        "lima"=> "perù",
        "citta del messico"=> "messico",
        "londra"    => "UK",
        "teheran"=> "iran",
        "bangkok"=> "thailandia",
        "bogota"=> "colombia",
        "hanoi"=> "vietnam",
        "riad"=> "arabia saudita",
        "baghdad"=> "iraq",
        "santiago del cile"=> "cile",
        "caracas"=> "venezuela",
        "ankara"=> "turchia",
        "singapore"=> "singapore",
        "luanda"=> "angola",
        "nairobi"=> "kenya",
        "citta del guatemala"=> "guatemala",
        "amman"=> "giordania",
        "kabul"=> "afghanistan",
        "sanaa"=> "yemen",
        "berlino"=> "germania",
    );

    $cittaScelta = $citta[ $_GET['a'] ]; // 'id' è la chiave nella query string

    echo '<html>';
    echo '<head>';
    echo '<title>citta e stati</title>';
    echo '</head>';
    echo '<body>';
    echo '<h2>' . 'città in elenco con relativo stato di appartenenza:' . '</h2>';

        //   foreach ($citta as $key => $value) {
        //       echo '<p>' . $key . '</p>';} // Stampa: chiavi dell'array, ovvero le città

    $keys_string = implode(", ", array_keys($citta)) . PHP_EOL; //calcola la funzione IMPLODE della variabile chiamata da noi $keys_string 
    echo '<big>' . $keys_string . '</big>' . PHP_EOL; //stampa la funzione IMPLODE della variabile calcolata $keys_string

    echo PHP_EOL;

    $values_string = implode(", ", array_values($citta)) . PHP_EOL; //calcola la funzione IMPLODE della variabile chiamata da noi $values_string
    echo '<pre>' . $values_string . '</pre>' . PHP_EOL; //stampa la funzione IMPLODE della variabile calcolata $values_string   

    // echo '<h1>Città scelta: ' . htmlspecialchars($_GET["id"]) .'</h1>' . PHP_EOL; //  printa quello che si scrive nella barra indirizzi, senza ID e senza caratteri speciali
    
    echo '<h1>Città scelta: ' . $_GET["a"] .'</h1>' . PHP_EOL; //  questa serve a printare quello che si scrive nella barra indirizzi (senza ID)
    echo PHP_EOL;
    echo '<h1>il suo Stato di appartenenza è: ' . $citta[ $_GET['a'] ] . '</h1>' . PHP_EOL;  //stampa il VALORE associato alla CHIAVE inserita dall'utente (nel GET)
    echo '</body>';
    echo '</html>';


    // echo      ---> non printa gli array
    // print_r() ---> printa gli array

    // git config --global user.name "michelangelo"
    // git config --global user.name "mikybeeh@hotmail.it"
    