<?php

    include 'lib_render.php';
    include 'lib_somma.php';


    $output = somma($_POST['primo'], $_POST['secondo']);



    $pagina2 = render_1('risultato.html', $pagine[1], $output);
    echo $pagina2;



    