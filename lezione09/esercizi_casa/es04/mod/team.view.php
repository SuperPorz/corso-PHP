<?php

    $elenco_teams = Team\lista();

    # ARRAY CAMPI INPUT
    $input_team_attributi = array (
        
        'hidden' => array (
            'type' => 'hidden',
            'name' => 'id',
            'value' => isset($_GET['edit_id']) && !empty($_GET['edit_id']) ? $_GET['edit_id'] : ''
        ),
        'nome_team' => array(
            'type' => 'text',
            'name' => 'nome_team',
            'placeholder' => 'nome team',
            'value' => isset($_GET['edit_id']) && !empty($_GET['edit_id']) ? $elenco_teams[$_GET['edit_id']]['nome_team'] : '',
            '' => 'required',
        ),
        'punteggio' => array(
            'type' => 'number',
            'name' => 'punteggio',
            'placeholder' => 'punteggio team',
            'value' => isset($_GET['edit_id']) && !empty($_GET['edit_id']) ? $elenco_teams[$_GET['edit_id']]['punteggio'] : '',
            'min' => 0,
            'max' => 999,
            '' => 'required',
        ),
        'submit' => array(
            'type' => 'submit',
            'value' => 'Inserisci',
        ),
    );


    # COSTRUZIONE FORM
    $form = Render\tag('form', ['action' => 'lista-teams.html', 'method' => 'post'], '{{select}}{{fields}}');
    $p['contenuto']['INSERIMENTO_DATI'] = $form;

    
    # COSTRUZIONE CAMPI INPUT    
    $tag_input = '';
    foreach($input_team_attributi as $k => $v) {
        $tag_input .= Render\tag('input', $v);
    }
    $p['contenuto']['fields'] = $tag_input;
    
    
    # COSTRUZIONE TABELLA
    $p['contenuto']['table2'] = Render\build_tab($elenco_teams, 'lista-teams');
    
