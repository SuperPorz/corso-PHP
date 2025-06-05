<?php

    include 'libreria.php';
    include 'database.php';

    $uscita = render_1($pagine[1]["template"], $pagine[1]);

    $uscita = creaCampi('{{input_campi}}', $campi_input, $uscita);

    echo $uscita;

    

