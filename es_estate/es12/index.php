<?php

    




    # RENDER FINALE
    $render = file_get_contents('tpl/main.html');
    $render = str_replace('{{options}}', $opzioni, $render);
    echo $render;