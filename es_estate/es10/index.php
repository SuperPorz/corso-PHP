<?php

    /* 

    esercizio 10
    Scrivere un programma nel quale sia possibile pianificare una maratona cinematografica in una multisala. 
    Creare un array associativo per memorizzare titolo, genere e orari delle proiezioni. Chiedere all'utente 
    di specificare uno o più generi di preferenza, e proporgli la soluzione che consente di vedere più film 
    di quei generi nel corso della giornata. Nel programma non devono esserci sovrapposizioni e dev'essere 
    prevista una pausa per il pranzo dall'una alle due e una pausa per la cena dalle otto alle nove. La maratona 
    comincia alle undici di mattina e finisce a mezzanotte.

    * 11:00 - 13:00 --> 120 min 
    * 14:00 - 20:00 --> 360 min 
    * 21:00 - 24:00 --> 180 min 

    */

    # PREPARAZIONE
    include 'inc/films_db.php';
    include 'lib/func.php';

    $temp_genere = [];
    $temp_mattina = [];
    $temp_pomeriggio = [];
    $temp_sera = [];
    $maratona_mattina = [];
    $maratona_pomeriggio = [];
    $maratona_sera = [];
    $minutaggio_pom = 360;
    $minutaggio_ser = 180;
    $durate_film = [];
    $flag = true;
    $str_matt= '';
    $str_pome = '';
    $str_sera = '';

    $generi = [
        'azione',
        'avventura',
        'fantasy',
        'scifi',
        'horror',
    ];


    # ALGORITMO MARATONA
    if (isset($_POST) && !empty($_POST)) {

        #preparazione lista temporanea con generi scelti
        foreach($_POST as $genere) {
            foreach($database as $film) {
                if ($film['genere'] == $genere) {
                    $temp_genere[] = $film;
                }
            }
        }


        # 1: FASCIA MATTINA
        #metto tutti i film <120 min in lista temp (per poter ciclare)
        foreach ($temp_genere as $film) {
            if ($film['durata'] <= 120) {
                $temp_mattina[] = $film;
            }
        }
        $maratona_mattina[] = $temp_mattina[rand(0, rand(0, count($temp_mattina) - 1))]; //scelgo un film a caso dalla lista temp e butto dentro lista finale mattina
        unset($temp_genere[array_search($film, $temp_genere)]); //elimino il film da lista temporanea
        unset($temp_mattina[array_search($film, $temp_mattina)]); //elimino il film da lista temporanea
        $temp_genere = array_values($temp_genere);
        $temp_mattina = array_values($temp_mattina); //riordino gli indici dell'array


        # 2: FASCIA POMERIGGIO
        #metto tutti i film in lista temp (per poter ciclare)
        foreach ($temp_genere as $film) {
            $temp_pomeriggio[] = $film;
        }

        #creo lista con i minutaggi dei film (serve per compilare la maratona)
        foreach ($temp_genere as $film) {
            $durate_film[] = $film['durata'];
        }

        #trovo il valore di durata più basso (sovrascrivo la variabile)
        $durata_min = min($durate_film);

        #calcolo la maratorna pomeridiana
        while ($flag) {
            $x = $temp_pomeriggio[rand(0, count($temp_pomeriggio) - 1)]; //pesco un film a caso dalla lista temp
            
            if ($x['durata'] <= $minutaggio_pom) {
                $maratona_pomeriggio[] = $x; //se durata < minutaggio residuo => aggiungo a lista finale
                $minutaggio_pom -= $x['durata']; //aggiorno il minutaggio residuo per il pomeriggio
                unset($temp_genere[array_search($film, $temp_genere)]);
                unset($temp_pomeriggio[array_search($film, $temp_pomeriggio)]);
                $temp_genere = array_values($temp_genere);
                $temp_pomeriggio = array_values($temp_pomeriggio);
            }
            if ($minutaggio_pom <= $durata_min) { //se minutaggio residuo < del film più breve => fine maratona pomeriggio
                $flag = false; //uscita ciclo
            }
        }
        $flag = true; //risetto la flag su true


        # 3: FASCIA SERA
        foreach ($temp_genere as $film) { //metto tutti i film <120 min in lista temp
            if ($film['durata'] <= 180) {
                $temp_sera[] = $film;
            }
        }

        #aggiorno la lista con i minutaggi dei film (serve per compilare la maratona)
        $durate_film = []; //svuoto la lista
        foreach ($temp_genere as $film) {
            $durate_film[] = $film['durata']; //ricreo la lista
        }

        #trovo il valore di durata più basso
        $durata_min = min($durate_film);

        #calcolo la maratorna pomeridiana
        while ($flag) {
            $x = $temp_sera[rand(0, count($temp_sera) - 1)]; //pesco un film a caso dalla lista temp
            if ($x['durata'] <= $minutaggio_ser) {
                $maratona_sera[] = $x; //se durata < minutaggio residuo => aggiungo a lista finale
                $minutaggio_ser -= $x['durata']; //aggiorno il minutaggio residuo per la sera
                unset($temp_genere[array_search($film, $temp_genere)]);
                unset($temp_sera[array_search($film, $temp_sera)]);
                $temp_genere = array_values($temp_genere);
                $temp_sera = array_values($temp_sera);
            }
            if ($minutaggio_ser <= $durata_min) { //se minutaggio residuo < del film più breve => fine maratona pomeriggio
                $flag = false; //uscita ciclo
            }
        }
        $flag = true; //risetto la flag su true
    }


    # AGGIUNTA OPTIONS TIPO CHECKBOX (per gli optionals)
    $options = '';
    foreach($generi as $k => $v) {
        $options .= "<br><input 
            type=\"checkbox\" 
            id=\"input\" 
            name=\"" . $k ."\" " . 
            "value=\"". $v ."\" 
            placeholder=\"". $v ."\">" . 
            "<label for=\"" .$v ."\">" . $v ."</label>";
    }


    # RENDER FINALE
    if (isset($_POST) && !empty($_POST)) {
        list($maratona_mattina, $maratona_pomeriggio, $maratona_sera) = 
            calcola_orari_maratona($maratona_mattina, $maratona_pomeriggio, $maratona_sera);
}
    $str_matt = crea_lista_ul($maratona_mattina, $str_matt);
    $str_pome = crea_lista_ul($maratona_pomeriggio, $str_pome);
    $str_sera = crea_lista_ul($maratona_sera, $str_sera);


    $render = file_get_contents('tpl/main.html');
    $render = str_replace('{{options}}', $options, $render);
    $render = str_replace('{{maratona_mattina}}', $str_matt, $render);
    $render = str_replace('{{maratona_pomeriggio}}', $str_pome, $render);
    $render = str_replace('{{maratona_sera}}', $str_sera, $render);
    echo $render;
    