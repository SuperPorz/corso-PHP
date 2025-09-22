<?php

    namespace Tema;

    function memorizza_tema_scelto($tema) {
        
        $lettura = fopen('./cookie/tema.txt', 'w+');
        fwrite($lettura, $tema);
        fclose($lettura);
        return true;
    }

    function leggi_tema() {
        $lettura = file_get_contents('./cookie/tema.txt', 'w+');
        return $lettura;
    }
    