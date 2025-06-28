<?php

    $elenco_piloti = Piloti\lista();

    # ARRAY CAMPI INPUT
    $input_piloti_attributi = array (
        
        'hidden' => array (
            'type' => 'hidden',
            'name' => 'id',
            'value' => isset($_GET['edit_id']) && !empty($_GET['edit_id']) ? $_GET['edit_id'] : ''
        ),
        'nome' => array(
            'type' => 'text',
            'name' => 'nome',
            'placeholder' => 'nome pilota',
            'value' => isset($_GET['edit_id']) && !empty($_GET['edit_id']) ? $elenco_piloti[$_GET['edit_id']]['nome'] : '',
            '' => 'required',
        ),
        'punteggio' => array(
            'type' => 'number',
            'name' => 'punteggio',
            'placeholder' => 'punteggio',
            'value' => isset($_GET['edit_id']) && !empty($_GET['edit_id']) ? $elenco_piloti[$_GET['edit_id']]['punteggio'] : '',
            '' => 'required',
        ),
        'submit' => array(
            'type' => 'submit',
            'value' => 'Inserisci',
        ),
    );

    # COSTRUZIONE FORM
    $form = Render\tag('form', ['action' => 'lista-piloti.html', 'method' => 'post'], '{{select}}{{fields}}');
    $p['contenuto']['INSERIMENTO_DATI'] = $form;


    # COSTRUZIONE SELECT (da sostituire poi con {{select}})
    $elenco_teams = Team\lista();
    $tendina = '';
    foreach ($elenco_teams as $id_team => $dati_team) { 
        $tendina .= Render\tag('option', ['value' => $dati_team['nome_team']], $dati_team['nome_team']);
    }
    $select = Render\tag('select', ['name' => 'team'], $tendina);
    $p['contenuto']['select'] = $select;


    # COSTRUZIONE CAMPI INPUT (da sostituire poi con {{fields}})
    $tag_input = '';
    foreach($input_piloti_attributi as $k => $array_campi) {
        $tag_input .= Render\tag('input', $array_campi);
    }
    $p['contenuto']['fields'] = $tag_input;
    

    # COSTRUZIONE TABELLA
    $elenco_piloti = Piloti\lista();
    $p['contenuto']['table1'] = Render\build_tab($elenco_piloti, 'lista-piloti');