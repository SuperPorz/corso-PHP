<?php

    /*
    ###############################################################
    ####################### PREPARAZIONE ##########################
    ###############################################################
    */

    # INCLUDE
    include 'inc/functions.php';

    # COSTRUZIONE INPUT del FORM
    $materie = [
        'storia',
        'geografia',
        'matematica',
        'scienze',
        'informatica',
        'economia',
        'lettere',
    ];

    $opzioni = '';
    foreach($materie as $materia) {

        $opzioni .= '<input 
            type="number"
            id="input"
            name="'.$materia.'"
            placeholder="voto ' .$materia.'" min="0" max="10" step="0.1" required>
            <label for="'.$materia.'">'.strtoupper($materia).'</label><br>';
    }

    /*
    ###############################################################
    ################# INSERIMENTO/MODIFICA ########################
    ###############################################################
    */

    # INSERIMENTO STUDENTE+VOTI NEL DB
    if (isset($_POST['nome']) && !empty($_POST['nome'])) {

        $array_voti = [];
        foreach($_POST as $chiave => $valore) {
            if ($chiave != 'nome') {
                $array_voti[] = $valore;    
            }
        }
        aggiungi($_POST['nome'], $array_voti);
    }


    #ELIMINAZIONE STUDENTE DAL DB
    if (isset($_GET['azione']) && $_GET['azione'] == 'elimina') {

        elimina($_GET['id']);
    }

    /*
    ##################################################
    ################# CALCOLI ########################
    ##################################################
    */

    # PREPARAZIONE VARIABILI
    $registro = lista();
    $migliore = '';
    $array_migliori_10 = [];
    $array_peggiori_20 = [];
    $str_migliori_10 = '';
    $str_peggiori_20 = '';
    $str_gruppi_5 = '';
    $str_studenti = '';
    $media_studenti = [];
    $tot = 0;


    # LISTA STUDENTI REGISTRATI + num. TOTALE STUDENTI
    $str_studenti = '<p>';
    if (is_array($registro)) {
        foreach($registro as $studente) {
            $str_studenti .= $studente['nome'] . '; ';
        }
        $tot = count($registro);
    }
    $str_studenti .= '</p>';


    # CALCOLO MEDIA VOTI
    if (is_array($registro)) {
        foreach($registro as $studente) {
            $media = 0;
            if (isset($studente['voti']) && is_array($studente['voti'])) {
                foreach($studente['voti'] as $voto) {
                    if (is_numeric($voto)) {
                        $media += $voto;                
                    }
                }
                $media = $media / 7; // media diviso numero materie
                $media_studenti[$studente['nome']] = round($media, 2);
            }
        }
    }


    # CALCOLO MIGLIORI/PEGGIORI
    if (count($registro) < 30) {
        echo 'REGISTRO NON COMPLETATO, INSERIRE ALMENO 30 STUDENTI';
    }
    else {
        #calcolo classifica (ordino dal peggiore al migliore)
        arsort($media_studenti);
    
        #migliore (ultimo nell'array ordinato)
        $migliore = '<ul><li>' .array_key_first($media_studenti).
            ' => '.$media_studenti[array_key_first($media_studenti)]. '</ul></li>';
    
        #migliori 10 (ultimi 10)
        $array_migliori_10 = array_slice($media_studenti, 0, 10, true);
        
        #peggiori 20 (primi 20)
        $array_peggiori_20 = array_slice($media_studenti, -20, 20, true);
    }


    # CALCOLO GRUPPI DI RECUPERO
    #lista iniziale
    $lista_recupero = [];
    if (is_array($registro)) {
        foreach($registro as $studente) {
            if (isset($studente['voti']) && is_array($studente['voti'])) {
                foreach($studente['voti'] as $voto) {
                    if (is_numeric($voto) && $voto < 6) {
                        $lista_recupero[] = $studente['nome'];
                        break;
                    }
                }
            }
        }
    }

    #gruppi da 5
    $array_gruppi_5 = array_chunk($lista_recupero, 5);

    /*
    ######################################################
    ################# VISUALIZZAZIONE ####################
    ######################################################
    */

    # UNORDERED LIST - MIGLIORI
    $str_migliori_10 = crea_ul($array_migliori_10);

    # UNORDERED LIST - PEGGIORI
    $str_peggiori_20 = crea_ul($array_peggiori_20);

    # UNORDERED LIST - GRUPPI RECUPERO
    foreach($array_gruppi_5 as $gruppo) {
        $str_gruppi_5 .= crea_ul_nomi($gruppo);
    }


    # RENDER FINALE
    $render = file_get_contents('tpl/main.html');
    $render = str_replace('{{options}}', $opzioni, $render);
    $render = str_replace('{{tot}}', $tot, $render);
    $render = str_replace('{{studenti_registrati}}', $str_studenti, $render);
    $render = str_replace('{{miglior_studente}}', $migliore, $render);
    $render = str_replace('{{top10_studenti}}', $str_migliori_10, $render);
    $render = str_replace('{{peggiori20_studenti}}', $str_peggiori_20, $render);
    $render = str_replace('{{gruppi_recupero}}', $str_gruppi_5, $render);
    echo $render;