<?php

    # LETTURA DATABASE
    $database_campi = Campi\lista();  

    
    # ARRAY CAMPI INPUT
    $input_campi_attributi = array (
        
        'hidden' => array (
            'type' => 'hidden',
            'name' => 'id',
            'value' => isset($_GET['edit_id']) && !empty($_GET['edit_id']) ? $_GET['edit_id'] : ''
        ),
        'nome_campo' => array(
            'type' => 'text',
            'name' => 'nome_campo',
            'placeholder' => 'nome campo',
            'value' => isset($_GET['edit_id']) && !empty($_GET['edit_id']) ? $database_campi[$_GET['edit_id']]['nome_campo'] : '',
            '' => 'required',
        ),
        'submit' => array(
            'type' => 'submit',
            'value' => 'Inserisci',
        ),
    );


    # COSTRUZIONE FORM
    $form = Render\tag('form', ['action' => 'gestione-campi.html', 'method' => 'post'], '{{select}}{{fields}}');
    $p['contenuto']['FORM'] = $form;


    # COSTRUZIONE CAMPI INPUT (da sostituire poi con {{fields}})
    $tag_input = '';
    foreach($input_campi_attributi as $k => $array_campi) {
        $tag_input .= Render\tag('input', $array_campi);
    }
    $p['contenuto']['fields'] = $tag_input;


    # COSTRUZIONE TABELLE  
    $p['contenuto']['table'] = Render\build_tab($database_campi, 'gestione-campi'); // tabella piloti