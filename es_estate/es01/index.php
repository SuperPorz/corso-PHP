<?php
    $collezione = array (
        'Thriller' => array(
            'autore' => 'Micheal Jackson',
            'anno' => 1982,
            'genere' => 'Pop'
        ),
        'Back In Back' => array(
            'autore' => 'AC/DC',
            'anno' => 1980,
            'genere' => 'Hard Rock'
        ),
        'The Bodyguard' => array(
            'autore' => 'Whitney Houston',
            'anno' => 1992,
            'genere' => 'Pop'
        ),
        'The Dark Side of the Moon' => array(
            'autore' => 'Pink Floyd',
            'anno' => 1973,
            'genere' => 'Progressive Rock'
        ),
        'Their Greatest Hits' => array(
            'autore' => 'Eagles',
            'anno' => 1976,
            'genere' => 'Country Rock'
        ),        
    );


    # COSTRUZIONE ELENCO HTML
    $lista = '';
    foreach($collezione as $k => $value) {
        $lista .= '<li id="titoli">' . $k . '</li>';
        $lista .= '<ul>';
        foreach ($value as $k2 => $v2) {
            $lista .= '<li>' . $k2 . ': ' . $v2 . '</li>';
        }
        $lista .= '</ul>';
    }


    # RENDERING FINALE
    $render = file_get_contents('tpl/main.html');
    $render = str_replace('{{albums}}', $lista, $render);
    echo $render;