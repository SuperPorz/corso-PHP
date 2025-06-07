<?php

    $pagine = array(
        'index' => array(
            'contenuto' => array(
                'titolo' => 'Index',
                'testo' => 'pagina Index',
            ),
            'template' => 'tpl/index.html',
        ),

        'PAGINA_A' => array(
            'contenuto' => array(
                'titolo' => 'pag_A',
                'testo' => 'Questa è la pagina A',
                'link_AB' => './PAGINA_B.html',
            ),
            'template' => 'tpl/ab.html',
        ),

        'PAGINA_B' => array(
            'contenuto' => array(
                'titolo' => 'pag_B',
                'testo' => 'Questa è la pagina B',
                'link_AB' => './PAGINA_A.html',
            ),
            'template' => 'tpl/ab.html',
        ),
    );