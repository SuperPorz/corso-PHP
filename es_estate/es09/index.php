<?php

    /* 

    esercizio 09
    Scrivere un programma per gestire l'assegnazione delle camere durante una gita scolastica. 
    Creare un array associativo per memorizzare gli studenti. L'utente deve poter inserire un numero
    arbitrario di studenti con le loro preferenze in termini di amicizie. Produrre l'elenco degli 
    accoppiamenti per le camere in modo che non ci siano camere miste, che più studenti possibile 
    finiscano in camera con un amico, e che ci sia il minor numero di camere singole possibile.

    $array_studenti = [
        0 => [
            nome => marco
            genere => U
            preferenze => [sandro, gioele, carlo]
        ],

        1 => [
            nome => andrea
            genere => U
            preferenze => [marco, gabriele, franco]
        ],
    ]

    */

    # PREPARAZIONE
    $dati_studenti = [];
    $camere_uomini = [];
    $camere_donne = [];
    $camere_singole = [];
    $lista_chiusa = false;

    function check_preferenze($preferenza, $nome) {
        if ($preferenza == $nome) {
            return true;
        }
        else {
            return false;
        }
    }


    # MEMORIZZAZIONE DATI SUGLI STUDENTI IN GITA
    if (isset($_POST['nome']) && !empty($_POST['nome'])
        && isset($_POST['genere']) && !empty($_POST['genere'])
        && isset($_POST['preferenze']) && !empty($_POST['preferenze'])) {

        #trasformo stringa preferenze in array di nomi
        $stringa_preferenze = $_POST['preferenze'];
        $array_preferenze = explode(',', $stringa_preferenze);
        
        #costruisco l'array con i dati inviati dal client
        $dati_studenti[] = [
            'nome' => $_POST['nome'],
            'genere' => $_POST['genere'],
            'preferenze' => $array_preferenze
        ];
    }


    # DICHIARAZIONE CHIUSURA DELLA LISTA
    if (isset($_GET['lista_chiusa'])) {
        $lista_chiusa = true;
        header('location: index.php');
    }


    # ALGORITMO PER L'ASSEGNAZIONE DELLE CAMERE (si attiva solo a chiusura lista) 
    # parte 1: primi accoppiamenti
    if ($lista_chiusa == true) {
        foreach($dati_studenti as $studente) {
            if ($studente['genere'] == 'U') {
                if ($camere_uomini == []) {
                    $index = '00';
                    $camera = 'camera-' . $index;
                    $camere_uomini[$camera] = $studente['nome'];
                    foreach($studente['preferenze'] as $k => $v) {
                        $camere_uomini[$camera] += $v;
                    }
                    $index = str_increment($index);
                }
                else {
                    foreach($camere_uomini as $camera => $occupanti) {
                        foreach ($occupanti as $k1 => $v1) {
                            if ($studente['nome'] == $v1) { // Lo studente è già in questa camera
                                // Controllo se ha preferenze che corrispondono ad altri occupanti
                                $altri_occupanti = array_filter($occupanti, function($nome) use ($studente) {
                                    return $nome != $studente['nome'];
                                });
                                $preferenze_matchate = array_intersect($studente['preferenze'], $altri_occupanti);
                                
                                if (!empty($preferenze_matchate)) {
                                    break; // Ha preferenze che matchano, camera va bene
                                }
                                else {
                                    // Nessuna preferenza corrisponde -> camera singola
                                    $camera = 'camera-' . $index;
                                    $camere_singole[$camera] = $studente['nome'];
                                    $index = str_increment($index);
                                }
                            }
                            else { // Lo studente non è in questa camera
                                // Controllo se ha preferenze che corrispondono agli occupanti
                                $preferenze_matchate = array_intersect($studente['preferenze'], $occupanti);
                                
                                if (!empty($preferenze_matchate)) {
                                    // Ha preferenze che corrispondono a questa camera
                                    $occupanti[] = $studente['nome'];
                                    break;
                                }
                            }
                        }
                    }
                }
            }
            else {
                if ($studente['genere'] == 'D') {
                    if ($camere_donne == []) {
                        $index = '00';
                        $camera = 'camera-' . $index;
                        $camere_donne[$camera] = $studente['nome'];
                        foreach($studente['preferenze'] as $k => $v) {
                            $camere_donne[$camera] += $v;
                        }
                        $index = str_increment($index);
                    }
                    else {
                        foreach($camere_donne as $camera => $occupanti) {
                            foreach ($occupanti as $k1 => $v1) {
                                if ($studente['nome'] == $v1) { // Lo studente è già in questa camera
                                    // Controllo se ha preferenze che corrispondono ad altri occupanti
                                    $altri_occupanti = array_filter($occupanti, function($nome) use ($studente) {
                                        return $nome != $studente['nome'];
                                    });
                                    $preferenze_matchate = array_intersect($studente['preferenze'], $altri_occupanti);
                                    
                                    if (!empty($preferenze_matchate)) {
                                        break; // Ha preferenze che matchano, camera va bene
                                    }
                                    else {
                                        // Nessuna preferenza corrisponde -> camera singola
                                        $camera = 'camera-' . $index;
                                        $camere_singole[$camera] = $studente['nome'];
                                        $index = str_increment($index);
                                    }
                                }
                                else { // Lo studente non è in questa camera
                                    // Controllo se ha preferenze che corrispondono agli occupanti
                                    $preferenze_matchate = array_intersect($studente['preferenze'], $occupanti);
                                    
                                    if (!empty($preferenze_matchate)) {
                                        // Ha preferenze che corrispondono a questa camera
                                        $occupanti[] = $studente['nome'];
                                        break;
                                    }
                                }
                            }
                        }
                    }
                }
            }    
        }
    }


    # COSTRUZIONE LISTE HTML (UL): DATI STUDENTI
    $lista_studenti = '<ul>';
    foreach ($dati_studenti as $studente) {
        $lista_studenti .= '<li><ul>';
        foreach($studente as $k => $v) {
            $lista_studenti .= '<li>' . $k . ': ' . $v . '</li>';
        }
        $lista_studenti .= '</ul></li>';
    }
    $lista_studenti .= '</ul>';


    # COSTRUZIONE LISTE HTML (UL): CAMERE UOMINI
    $lista_camere_U = '<ul>';
    foreach ($camere_uomini as $k => $v) {
        $lista_camere_U .= '<li>' . $k . ': ' . $v . '</li>';
    }
    $lista_camere_U = '</ul>';


    # COSTRUZIONE LISTE HTML (UL): CAMERE DONNE
    $lista_camere_D = '<ul>';
    foreach ($camere_donne as $k => $v) {
        $lista_camere_D .= '<li>' . $k . ': ' . $v . '</li>';
    }
    $lista_camere_D = '</ul>';


    # COSTRUZIONE LISTE HTML (UL): CAMERE SINGOLE
    $lista_camere_S = '<ul>';
    foreach ($camere_singole as $k => $v) {
        $lista_camere_S .= '<li>' . $k . ': ' . $v . '</li>';
    }
    $lista_camere_S = '</ul>';


    # RENDER FINALE
    $render = file_get_contents('tpl/main.html');
    $render = str_replace('{{lista_studenti}}', $lista_studenti, $render);
    $render = str_replace('{{camere_uomini}}', $lista_camere_U, $render);
    $render = str_replace('{{camere_donne}}', $lista_camere_D, $render);
    $render = str_replace('{{camere_singole}}', $lista_camere_S, $render);
    echo $render;
    