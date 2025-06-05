<?php

    require 'lib/render.php';

    $render_pagina = render($pagine[3]['template'], $pagine[3]);

    $render_pagina = creaSelect('{{menu_tendina}}', $calcolo, $render_pagina);


    #sostuituiamo i campi hidden per portarci dietro chiavi e valori
    switch (True) {
        case (array_key_exists('lato1', $_POST)):  #caso rettangolo 

            $render_pagina = str_replace('{{name_1}}', 'lato1', $render_pagina);
            $render_pagina = str_replace('{{name_2}}', 'lato2', $render_pagina);
            
            $render_pagina = str_replace('{{val_1}}', $_POST['lato1'], $render_pagina);
            $render_pagina = str_replace('{{val_2}}', $_POST['lato2'], $render_pagina);
        
            echo $render_pagina;
            break;

        case (array_key_exists('base', $_POST)):  #caso triangolo 

            $render_pagina = str_replace('{{name_1}}', 'base', $render_pagina);
            $render_pagina = str_replace('{{name_2}}', 'altezza', $render_pagina);
            
            $render_pagina = str_replace('{{val_1}}', $_POST['base'], $render_pagina);
            $render_pagina = str_replace('{{val_2}}', $_POST['altezza'], $render_pagina);
        
            echo $render_pagina;
            break;

        case (array_key_exists('raggio', $_POST)):  #caso cerchio

            $render_pagina = str_replace('{{name_1}}', 'raggio', $render_pagina);
            $render_pagina = str_replace('{{name_2}}', '', $render_pagina);
            
            $render_pagina = str_replace('{{val_1}}', $_POST['raggio'], $render_pagina);
            #$render_pagina = str_replace('{{val_2}}', $_POST['null'], $render_pagina);
        
            echo $render_pagina;
            break;      
        
    }