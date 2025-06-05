<?php

    require 'lib/render.php';

    $render_pagina = render($pagine[2]['template'], $pagine[2]);

    $render_pagina = creaCampi('{{campi}}', $campi[$_POST['figura']], $render_pagina);

    echo $render_pagina;