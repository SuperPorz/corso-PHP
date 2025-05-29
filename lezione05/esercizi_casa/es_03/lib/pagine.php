<?php

    include_once 'database.php';
    include_once 'funzioni.php';

    

    # se non è settata nessuna pagina, carica di default quella con chiave = 1
    

    if(! isset($_POST['modello'])) {

        # PAGINA SCELTA MODELLO (INDEX)
        $pagina = $pagine[1];
        $output = render_1('templates/index.html', $pagina);
        $output = creaSelect('{{lista_piatti}}', $menu_piatti, $output); 
        echo $output; #come mai la variabile output non si sovrascrive?
    
    } elseif (isset($_POST['modello'])) {

        # PAGINA SCELTA ALLESTIMENTO
        $pagina = $pagine[2];
        $output = render_1('templates/index.html', $pagina);
        $output = creaSelect('{{lista_piatti}}', $menu_piatti, $output); 
        echo $output; #come mai la variabile output non si sovrascrive?

    } elseif (isset($_POST['allestimento'])) {

        # PAGINA PREZZO FINALE
        $pagina = $pagine[3];
        $piatto_scelto = $menu_piatti[$_POST['piatto']];
        $output2 = render_2('templates/prezzo.html', $pagina, $menu_piatti[$_POST['piatto']]);
        echo $output2;
    }