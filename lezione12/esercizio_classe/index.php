<?php

    // composer
    require_once 'lib/ext/autoload.php';

    // loader Twig
    $loader = new \Twig\Loader\FilesystemLoader('tpl');

    // ambiente Twig
    $twig = new \Twig\Environment($loader);

    // caricamento template
    $template = $twig->load('index.twig');

    // rendering template
    $lista = [
        array(
            'nome' => 'mario',
            'cognome' => 'rossi',
            'numero' => 509060
        ),
        array(
            'nome' => 'giovanna',
            'cognome' => 'pertini',
            'numero' => 875466
        ),
        array(
            'nome' => 'amilcare',
            'cognome' => 'lupi',
            'numero' => 458022
        ),
    ];

    echo $template->render(
        array(
            'lista_nomi' => $lista
        )
    );