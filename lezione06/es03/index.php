<?php

    require 'lib/render.php';

    $render_pagina = render($pagine[0]['template'], $pagine[0]);

    echo $render_pagina;