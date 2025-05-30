<?php

    include_once 'database.php';
    include_once 'funzioni.php';

    

    # se non è settata nessuna pagina, carica di default quella con chiave = 1
    
    switch (true) {

        case (! isset($_POST['modello']) && ! isset($_POST['allestimento'])) :
        
            # PAGINA SCELTA MODELLO (INDEX)
            $pagina = $pagine[1];
            $modelliAuto = array_column($saloneAuto, 'modello');  #funzione built-in STUPENDA
            $output = render_1('templates/index.html', $pagina);
            $output = creaSelect('{{modello}}', $modelliAuto, $output); 
            echo $output; #come mai la variabile output non si sovrascrive? -->prende valori da riga sopra, che contiene la stringa html
            break;

        case (isset($_POST['modello']) && ! isset($_POST['allestimento'])) :
        
            # PAGINA SCELTA ALLESTIMENTO
            $pagina = $pagine[2];
            $pagina['modello_selezionato'] = $_POST['modello'];
            $output = render_1('../templates/allestimenti.html', $pagina);
            $output = creaSelect('{{allestimento}}', $allestimenti, $output); 
            echo $output; #come mai la variabile output non si sovrascrive? -->prende valori da riga sopra, che contiene la stringa html
            break;

        # case (isset($_POST['modello']) && isset($_POST['allestimento'])) :
        default:    
            # PAGINA PREZZO FINALE
            $pagina = $pagine[3];
            #$auto_scelta = array_column($saloneAuto, 'prezzo');
            $output2 = render_2('../templates/prezzo.html', $pagina, $saloneAuto);            
            echo $output2;            
            break;

    }

    # $saloneAuto[$_POST['modello_selezionato']][$_POST['allestimento']]

   /*  if(! isset($_POST['modello'])) {

        # PAGINA SCELTA MODELLO (INDEX)
        $pagina = $pagine[1];
        $modelliAuto = array_column($saloneAuto, 'modello');  #funzione built-in STUPENDA
        $output = render_1('templates/index.html', $pagina);
        $output = creaSelect('{{modello}}', $modelliAuto, $output); 
        echo $output; #come mai la variabile output non si sovrascrive? -->prende valori da riga sopra, che contiene la stringa html
    
    } elseif (isset($_POST['modello'])) {

        # PAGINA SCELTA ALLESTIMENTO
        $pagina = $pagine[2];
        $pagina['modello_selezionato'] = $_POST['modello'];
        $output = render_1('../templates/allestimenti.html', $pagina);
        $output = creaSelect('{{allestimento}}', $allestimenti, $output); 
        echo $output; #come mai la variabile output non si sovrascrive? -->prende valori da riga sopra, che contiene la stringa html

    } elseif (isset($_POST['allestimento'])) {

        # PAGINA PREZZO FINALE
        $pagina = $pagine[3];
        $modello_index = $_POST['modello_selezionato']; # Uso il modello salvato
        $allestimento_type = $_POST['allestimento'];

         # Costruisco la chiave per accedere al prezzo
        $chiave_prezzo = 'allestimento_' . $allestimento_type;
        $prezzo = $saloneAuto[$modello_index][$chiave_prezzo];
        $modello = $saloneAuto[$modello_index]['modello'];
        
        $pagina['contenuto'] = "Hai scelto: " . $modello . " - " . ucfirst($allestimento_type) . " al prezzo di " . $prezzo;

        $auto_scelta = $saloneAuto[$_POST['allestimento']]; #che cazzo l'ho scritta a fare questa riga?
        $output2 = render_2('../templates/prezzo.html', $pagina, $saloneAuto[$_POST['prezzo']]);
        echo $output2;
    } */