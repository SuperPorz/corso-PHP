<?php

    # LETTURA DB e PREPARAZIONE
    include 'lib/functions.php';
    

    # COSTRUZIONE ARRAY ASSOCIATIVO (memorizzazione dati)
    if (isset($_POST['tappa']) && !empty($_POST['tappa'])
        && isset($_POST['km']) && $_POST['km'] !== '')
        {
            aggiunta_scrittura_elementi($_POST['tappa'], $_POST['km']);
        }


    # CALCOLO RISULTATO (km totali itinerario)
    $itinerario = lista();
    $distanza_tot = 0;
    foreach($itinerario as $tappa) {
        $distanza_tot += $tappa['km'];
    }


    # COSTRUZIONE ORDERED LIST CON TAPPE e KM
    $lista = costruzione_ol($itinerario);


    # ELIMINA DATI DAL DB
    if (isset($_GET['elimina'])) {
        file_put_contents('db/itinerario.db', '');
        $lista = costruzione_ol($itinerario);
        header('location: index.php');
    }


    # RENDER FINALE
    $render = file_get_contents('tpl/main.html');
    $render = str_replace('{{tappe}}', $lista, $render);
    $render = str_replace('{{risultato}}', $distanza_tot, $render);
    echo $render;