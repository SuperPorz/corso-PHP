<?PHP

    $persona = array(
        "nome" => "Michelangelo",
        "cognome" => "Stega",
        "eta" => 34,
        "citta" => "Bologna"
    );

    $generiPreferiti = array("techno", "pop", "jazz", "elettronica", "hardcore", "goa", "psytrance", "rap", "hip-hop");

    $generiOdiati = array("TRAP", "Taylor Swift", "SferaEsticazzi", "Gigi D'Alessio");

    echo '<h1>' . $persona["nome"] . ' ' . $persona["cognome"] . '</h1>' . PHP_EOL .
         '<p>' . 'Età: ' . $persona["eta"] . '</p>' . PHP_EOL .
         '<p>' . 'Città: ' . $persona["citta"] . '</p>' . PHP_EOL .
         '<h2>Al signor ' . $persona['nome'] . ' ' . $persona['cognome'] . ' piacciono i seguenti generi musicali: ' . '</h2>' . PHP_EOL .
         '<ul>' . PHP_EOL .
            '<li>' . $generiPreferiti[0] . '</li>' . PHP_EOL .
            '<li>' . $generiPreferiti[1] . '</li>' . PHP_EOL .
            '<li>' . $generiPreferiti[2] . '</li>' . PHP_EOL .
            '<li>' . $generiPreferiti[3] . '</li>' . PHP_EOL .
            '<li>' . $generiPreferiti[4] . '</li>' . PHP_EOL .
            '<li>' . $generiPreferiti[5] . '</li>' . PHP_EOL .
            '<li>' . $generiPreferiti[6] . '</li>' . PHP_EOL .
            '<li>' . $generiPreferiti[7] . '</li>' . PHP_EOL .
            '<li>' . $generiPreferiti[8] . '</li>' . PHP_EOL .  
         '</ul>' . PHP_EOL .       
         '<h2>Al signor ' . $persona['nome'] . ' ' . $persona['cognome'] . ' fanno letteralmente RIBREZZO i seguenti SCHIFI musicali: ' . '</h2>' . PHP_EOL .
         '<ul>' . PHP_EOL .
            '<li>' . $generiOdiati[0] . '</li>' . PHP_EOL .
            '<li>' . $generiOdiati[1] . '</li>' . PHP_EOL .
            '<li>' . $generiOdiati[2] . '</li>' . PHP_EOL .
            '<li>' . $generiOdiati[3] . '</li>' . PHP_EOL .
         '</ul>' . PHP_EOL ;
   