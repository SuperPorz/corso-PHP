<?php

    /*
    
    V = tensione   I = intensità di corrente    R = resistenza

    V = I * R      I = V / R       R = V / I

    */

    # FUNZIONI DI CALCOLO
    function tensione($i, $r) {
        $i = floatval($i);
        $r = floatval($r);
        return round($i * $r, 3);
    }

    function intensita($v, $r) {
        $v = (float)$v;
        $r = (float)$r;
        return round($v / $r, 3);
    }

    function resistenza($v, $i) {
        $v = floatval($v);
        $i = floatval($i);
        return round($v / $i, 3);
    }


    # MAIN PROGRAM
    $risultato = '';

    if ((isset($_POST['I']) && !empty($_POST['I']) && isset($_POST['R']) && !empty($_POST['R'])) ||
        (isset($_POST['V']) && !empty($_POST['V']) && isset($_POST['R']) && !empty($_POST['R'])) ||
        (isset($_POST['V']) && !empty($_POST['V']) && isset($_POST['I']) && !empty($_POST['I']))
    ) {
        switch ($_POST['calcolo']) {
    
            case 'tensione':
                $risultato = 'V = ' . tensione($_POST['I'], $_POST['R']) .' volt';
                break;
            
            case 'intensita':
                $risultato = 'I = ' . intensita($_POST['V'], $_POST['R']) .' ampere';
                break;
            
            case 'resistenza':
                $risultato = 'R = ' . resistenza($_POST['V'], $_POST['I']) .' ohm';
                break;
        }
    }


    # RENDER FINALE
    $render = file_get_contents('tpl/main.html');
    $render = str_replace('{{risultato}}', $risultato, $render);
    echo $render;