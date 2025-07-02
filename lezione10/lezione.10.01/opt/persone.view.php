<?php

    $righe = [];
    foreach( Persone\lista() as $persona ) {
        $righe[] = Render\render(
            'tpl/persone.table.row.html',
            [
                'id_p' => $persona['id_p'],
                'nome' => $persona['nome'],
                'numero' => $persona['numero']
            ]
        );
    }
    
    $lista = Render\render(
        'tpl/persone.table.html',
        [
            'lista' => implode('', $righe),
        ]
    );

    $form = Render\render(
        'tpl/persone.form.html',
        [
            'azione' => ( $_REQUEST['azione'] == 'modifica' ) ? 'modifica' : 'aggiungi',
            'id_p' => $_REQUEST['id_p'] ?? '',
            'nome' => $_REQUEST['nome'] ?? '',
            'numero' => $_REQUEST['numero'] ?? ''
        ]
    );

    $p['contenuto']['main'] = $lista . $form;
