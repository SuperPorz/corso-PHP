<?php

    include_once 'database.php';
    include_once 'funzioni.php';

    

    # se non è settata nessuna pagina, carica di default quella con chiave = 1

    if(! isset($_POST['piatto'])) {

        # PAGINA INDEX
        $pagina = $pagine[1];
        $output = render_1('templates/index.html', $pagina);
        $output = creaSelect('{{lista_piatti}}', $menu_piatti, $output); 
        echo $output;
    
    } else {

        # PAGINA INGREDIENTI
        $pagina = $pagine[2];
        $piatto_scelto = $menu_piatti[$_POST['piatto']];
        $output2 = render_2('templates/ingredienti.html', $pagina, $menu_piatti[$_POST['piatto']]);
        echo $output2;
        exit;
    }

        


    


        


   