<?php

    include 'lib_funzioni.php';
    include 'lib_calcolo.php';
    
    $risultato = tempo_percorrenza($_POST['campo1'], $_POST['campo2']);

    $render_pagina = render($pagine[2]['template'], $pagine[2]);

    $render_pagina = str_replace('{{risultato}}', $risultato, $render_pagina);

    echo $render_pagina;