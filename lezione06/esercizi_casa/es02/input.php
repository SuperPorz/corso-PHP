<?php

    include 'lib_funzioni.php';
    
    $render_pagina = render($pagine[1]['template'], $pagine[1]);

    $render_pagina = creaCampi('{{campi}}', $campi, $render_pagina);

    echo $render_pagina;

