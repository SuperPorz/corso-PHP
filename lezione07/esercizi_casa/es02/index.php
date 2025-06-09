<?php

    #librerie necessarie SEMPRE: "database.php" & "render.php"
    require_once 'lib/database.php';
    require_once 'lib/render.php';

    if ($_REQUEST['p'] == 'index') {

        #render della pagina principale index.html
        echo render($pagine['index']['template'], $pagine['index']['contenuto']);

        echo $_REQUEST['p'];

    } elseif ($_REQUEST['p'] == 'input') {

        #libreria "crea_campi.php" richiesta SOLO nella pagina index!!
        require_once 'lib/' . $pagine['input']['contenuto']['include'];

        #render della pagina input.html
        $render_pagina2 = render($pagine['input']['template'], $pagine['input']['contenuto']);     
        $render_pagina2 = creaCampi('{{campi}}', $campi, $render_pagina2);
        echo $render_pagina2;

    } elseif ($_REQUEST['p'] == 'risultato') {

        #libreria "calcolo.php" richiesta SOLO nella pagina risultato!!
        require_once 'lib/' . $pagine['risultato']['contenuto']['include'];

        #render della pagina risultato.html
        $risultato = tempo_percorrenza($_POST['campo1'], $_POST['campo2']);
        $render_pagina3 = render($pagine['risultato']['template'], $pagine['risultato']['contenuto']);
        $render_pagina3 = str_replace('{{testo}}','Il tempo di percorrenza previsto è: ' . $risultato . 
                            ' minuti' . ' (' . $risultato/60 . ' ore)', $render_pagina3);
        echo $render_pagina3;
    }
