<?php

    require 'lib/render.php';

    $render_pagina = render($pagine[1]['template'], $pagine[1]);

    $render_pagina = creaSelect('{{menu_tendina}}', $figure, $render_pagina);

    echo $render_pagina;