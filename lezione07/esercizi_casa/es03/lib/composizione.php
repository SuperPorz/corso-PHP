<?php

    $composizione_menu = array(

        'primo' => array(
            '{{nome_p}}' => $menu_primi[$_POST['primo']]['nome'],
            '{{ingredienti_p}}' => $menu_primi[$_POST['primo']]['ingredienti'],
            '{{prezzo_p}}' => $menu_primi[$_POST['primo']]['prezzo'],
            '{{img_p}}' => $menu_primi[$_POST['primo']]['img'],
        ),

        'secondo' => array(
            '{{nome_s}}' => $menu_secondi[$_POST['secondo']]['nome'],
            '{{ingredienti_s}}' => $menu_secondi[$_POST['secondo']]['ingredienti'],
            '{{prezzo_s}}' => $menu_secondi[$_POST['secondo']]['prezzo'],
            '{{img_s}}' => $menu_secondi[$_POST['secondo']]['img'],
        ),

        'dolce' => array(
            '{{nome_d}}' => $menu_dolci[$_POST['dolce']]['nome'],
            '{{ingredienti_d}}' => $menu_dolci[$_POST['dolce']]['ingredienti'],
            '{{prezzo_d}}' => $menu_dolci[$_POST['dolce']]['prezzo'],
            '{{img_d}}' => $menu_dolci[$_POST['dolce']]['img'],
        ),
    );
