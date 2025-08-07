<?php

    $discografia = array (

        'Black Sabbath' => array (
            1970 => 'Black Sabbath',
            1971 => ['Paranoid', 'Master of Reality'],
            1972 => 'Black Sabbath vol.4',
            1974 => 'Sabbath Bloody Sabbath',
            1975 => 'Sabotage',
            1976 => 'Technical Ecstasy',
            1978 => 'Never Say Die!',
            1980 => 'Heaven and Hell',
            1981 => 'Mob Rules',
            1983 => 'Born Again',
            1986 => 'Seventh Star',
            1987 => 'The Eternal Idol',
            1989 => 'Headless Cross',
            1990 => 'TYR',
            1992 => 'Dehumanizer',
            1994 => 'Cross Purposes',
            1995 => 'Forbidden'
        ),

        'Cugini di Campagna' => array (
            1972 => 'I Cugini Di Campagna',
            1973 => 'Anima Mia',
            1974 => 'Un\'Altra Donna',
            1975 => 'Preghiera',
            1976 => 'E\' Lei',
            1977 => 'Tu Sei Tu',
            1978 => 'Dentro l\'anima...e qualcosa die giorni passati',
            1980 => 'Meravigliosamente',
            1981 => 'Metallo',
            1982 => 'Gomma',
            1991 => 'KimEra',
            1997 => 'La Nostra Vera Storia',
            1998 => 'Amor Mio',
            1999 => ['Sarà', 'La Storia']
        ),

        'Nirvana' => array (
            1989 => 'Bleach',
            1991 => 'Nevermind',
            1992 => 'Incesticide',
            1993 => 'In Utero',
            1994 => 'MTV Unplugged in New York',
            1995 => 'Sliver - The Best of the Box',
            1996 => 'From the Muddy Banks of the Wishkah'
        ),

        'Guns N\' Roses' => array (
            1987 => 'Appetite for Destruction',
            1988 => 'G N\' R Lies',
            1991 => ['Use Your Illusion 1', 'Use Your Illusion 2'],
            1993 => 'The Spaghetti Incident?',
            1999 => 'Live Era \'87-\'93'
        )
    );


    # MAIN - RICERCA DATI SU RICHIESTA CLIENT
    $lista = '';

    if (isset($_POST['gruppo']) && !empty($_POST['gruppo'])
        && isset($_POST['anno']) && !empty($_POST['anno'])) {

        #test 1: se anno è associato a gruppo => passa a test2, altrimenti => errore
        if (array_key_exists($discografia[$_POST['gruppo']][$_POST['anno']], $discografia[$_POST['gruppo']])) {
            
            #test 2: se anno associato a più album => ciclo su iterabile per ottenere la lista UL
            if (is_array($discografia[$_POST['gruppo']][$_POST['anno']])) {
                foreach ($discografia[$_POST['gruppo']][$_POST['anno']] as $anno => $album) {
                    $lista .= '<li>' . $album . '</li>';
                }
            }
            else {
                $lista .= '<li>' . $discografia[$_POST['gruppo']][$_POST['anno']] . '</li>';
            }
        }
        else { 
            $lista = '<li> NESSUN ALBUM PUBBLICATO NELL\'ANNO INDICATO!';
        }
    }


    # COSTRUZIONE SELECT
    $options = '';
    foreach ($discografia as $k => $v) {
        $options .= "<option value=\"" .$k . "\">" . $k . "</option>";
    }


    # RENDERING FINALE
    $render = file_get_contents('tpl/main.html');
    $render = str_replace('{{options}', $options, $render); //render menu tendina
    $render = str_replace('{{albums}}', $lista, $render); //render risultati ricerca
    echo $render;