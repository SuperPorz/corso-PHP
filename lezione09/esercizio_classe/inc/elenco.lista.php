<?php

    /**
     * qui vanno le logiche per la visualizzazione della lista delle persone
     */

    $elenco = Elenco\lista();

    $righe = [];
    foreach ($elenco as $id => $cane) {
        $campi = [];
        $campi[] = HTML\tag('td', [], $id);
        $campi[] = HTML\tag('td', [], $cane['nome']);
        $campi[] = HTML\tag('td', [], $cane['anno_nascita']);
        $campi[] = HTML\tag('td', [],
            HTML\tag(
                'a',
                [ 'href' => './index.html?id=' . $id ],
                'modifica'
            )
        );            
        $campi[] = HTML\tag('td', [],
            HTML\tag(
                'a',
                [ 'href' => './gestione.html?elimina=' . $id ],
                'elimina'
            )
        );
        $righe[] = HTML\tag('tr', [], implode('', $campi));
    } 

    $p['contenuto']['testo'] = HTML\tag('table', [ 'border' => 1 ], implode('', $righe));

    $p['contenuto']['testo'] .= HTML\tag('hr');

    if( isset($_REQUEST['id']) && isset($elenco[$_REQUEST['id']]) ) {
        $cane = $elenco[ $_REQUEST['id'] ];
        $idField = [
            'field' => 'input',
            'type' => 'hidden',
            'name' => 'id',
            'value' => $_REQUEST['id'],
            'required' => 'required',
        ];
    } else {
        $cane = [];
        $idField = [];
    }

    $p['contenuto']['testo'] .= HTML\form(
        [ 'action' => './gestione.html', 'method' => 'post' ],
        [
            'id' => $idField,
            'nome' => [     'field' => 'input', 'type' => 'text',   'name' => 'nome',       'required' => '',   'placeholder' => 'nome',        'value' => ( isset($cane['nome']) ? $cane['nome'] : '' ) ],
            'anno_nascita' => [ 'field' => 'input', 'type' => 'text',   'name' => 'anno_nascita',   'required' => '',   'placeholder' => 'anno_nascita',    'value' => ( isset($cane['anno_nascita']) ? $cane['anno_nascita'] : '' ) ],
            'salva' => [    'field' => 'input', 'type' => 'submit', 'name' => 'salva',      'value' => 'salva' ],
        ]
    );
