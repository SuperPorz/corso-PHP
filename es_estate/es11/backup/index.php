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
    if (isset($_POST['nome']) && !empty(isset($_POST['nome']))) {

        $array_voti = [];
        foreach($_POST as $chiave_valore) {
            if ($_POST != 'nome') {
                $array_voti[] = $chiave_valore;    
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
    $str_migliori_10 = '';
    $str_peggiori_20 = '';
    $str_gruppi_5 = '';
    $str_studenti = '';
    $media_studenti = [];
    $media = 0;
    $tot = 0;


    # LISTA STUDENTI REGISTRATI + num. TOTALE STUDENTI
    $str_studenti = '<p>';
    foreach($registro as $studente) {
        $str_studenti .= $studente['nome'] . '; ';
    }
    $str_studenti .= '</p>';
    $tot = count($registro);


    # CALCOLO MEDIA VOTI
    foreach($registro as $studente) {
        foreach($studente as $k => $array_voti) {
            foreach($array_voti as $k2 => $k3) {
                if (is_numeric($v)){
    
                    $media += $v;                
                }
            }
        }
        $media = $media / 7; //media diviso numero materie
        $media_studenti[$studente['nome']] = $media;
    }


    # CALCOLO MIGLIORI/PEGGIORI
    if (count($registro) < 30) {
        echo 'REGISTRO NON COMPLETATO, INSERIRE ALMENO 30 STUDENTI';
    }
    else {
        #calcolo classifica
        asort($media_studenti);
    
        #migliore
        $migliore = array_key_first($media_studenti);
    
        #migliori 10
        $array_migliori_10 = array_slice($media_studenti, 0, 10);
    
        #peggiori 20
        $array_peggiori_20 = array_slice($media_studenti, -1, 20);
    }


    # CALCOLO GRUPPI DI RECUPERO
    #lista iniziale
    $lista_recupero = [];
    foreach($registro as $studente) {
        foreach($studente as $k => $v) {
            if (is_numeric($v) && $v < 6) {
                $lista_recupero[] = $studente['nome'];
                break;
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
        $str_gruppi_5 .= crea_ul($gruppo);
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