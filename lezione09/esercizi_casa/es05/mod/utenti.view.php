<?php

    $database_utenti = Utenti\lista();

    # ARRAY CAMPI INPUT
    $input_utenti_attributi = array (
        
        'hidden' => array (
            'type' => 'hidden',
            'name' => 'id',
            'value' => isset($_GET['edit_id']) && !empty($_GET['edit_id']) ? $_GET['edit_id'] : ''
        ),
        'nome' => array(
            'type' => 'text',
            'name' => 'nome',
            'placeholder' => 'nome',
            'value' => isset($_GET['edit_id']) && !empty($_GET['edit_id']) ? $database_utenti[$_GET['edit_id']]['nome'] : '',
            '' => 'required',
        ),
        'cognome' => array(
            'type' => 'text',
            'name' => 'cognome',
            'placeholder' => 'cognome',
            'value' => isset($_GET['edit_id']) && !empty($_GET['edit_id']) ? $database_utenti[$_GET['edit_id']]['cognome'] : '',
            '' => 'required',
        ),
        'submit' => array(
            'type' => 'submit',
            'value' => 'Inserisci',
        ),
    );

    # COSTRUZIONE FORM
    $form = Render\tag('form', ['action' => 'registrazione-utenti.html', 'method' => 'post'], '{{fields}}');
    $p['contenuto']['FORM'] = $form;


    # COSTRUZIONE CAMPI INPUT (da sostituire poi con {{fields}})
    $tag_input = '';
    foreach($input_utenti_attributi as $k => $array_campi) {
        $tag_input .= Render\tag('input', $array_campi);
    }
    $p['contenuto']['fields'] = $tag_input;
    

    # COSTRUZIONE TABELLA
    $p['contenuto']['table'] = Render\build_tab($database_utenti, 'registrazione-utenti');