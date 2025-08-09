<?php

    # PREPARAZIONE
    $num = 0; //inizializzo a 0 il numero (il val. variabile cambierà)
    $numero_salvato = '';//memorizzo il numero
    $lista_fattori = [];
    $f = 1;

    if (isset($_POST['intero']) && !empty($_POST['intero'])) {
        $numero_salvato = intval($_POST['intero']);
        $num = intval($_POST['intero']);//variabile num verrà modificata
    }

    function is_primo($fattore) {
        // I numeri minori o uguali a 1 non sono primi
        if ($fattore <= 1) {
            return false;
        }
        // 2 è primo
        if ($fattore == 2) {
            return true;
        }
        // I numeri pari maggiori di 2 non sono primi
        if ($fattore % 2 == 0) {
            return false;
        }
        // Verifica i divisori dispari da 3 fino alla radice quadrata
        for ($i = 3; $i <= sqrt($fattore); $i += 2) {
            if ($fattore % $i == 0) {
                return false; // trovato un divisore, numero non primo
            }
        }
        return true; // nessun divisore trovato, numero primo
    }


    # MAIN PROGRAM
    #calcolo fattori primi
    while ($num > 1) {
        if (is_primo($f) === true && ($num % $f == 0)) {
            $num = $num / $f;
            $lista_fattori[] = $f;
        }
        else {
            $f += 1;
        }
    }

    #composizione stringa HTML con esponenti in apice (grafica) 
    $x = array_count_values($lista_fattori);
    $y = [];
    foreach ($x as $k => $v) {
        if ($v == 1) {
            $y[] = $k;
        }
        else {
            $y[] = $k . '<sup>' . $v . '</sup>';
        }
    }
    $nuova_lista = implode(' * ', $y);


    # RENDER FINALE
    $render = file_get_contents('tpl/main.html');
    $render = str_replace('{{fattori}}', $numero_salvato . ' = ' . $nuova_lista, $render);
    echo $render;
