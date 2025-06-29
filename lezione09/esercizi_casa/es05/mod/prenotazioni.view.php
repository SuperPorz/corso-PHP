<?php

    $database_prenotazioni = Prenotazioni\lista();
    $elenco_campi = Campi\lista();
    $elenco_utenti = Utenti\lista();

    # ARRAY CAMPI INPUT
    $input_prenotazioni_attributi = array (
        
        'hidden' => array (
            'type' => 'hidden',
            'name' => 'id',
            'value' => isset($_GET['edit_id']) && !empty($_GET['edit_id']) ? $_GET['edit_id'] : ''
        ),
        'data' => array(
            'type' => 'date',
            'name' => 'data',
            'placeholder' => 'data',
            'value' => isset($_GET['edit_id']) && !empty($_GET['edit_id']) ? $database_prenotazioni[$_GET['edit_id']]['data'] : '',
            '' => 'required',
        ),
        'submit' => array(
            'type' => 'submit',
            'value' => 'Inserisci',
        ),
    );

    $fasce = array (
        0 => '12-14',
        1 => '14-16',
        2 => '16-18',
        3 => '18-20',
    );


    # COSTRUZIONE FORM
    $form = Render\tag('form', ['action' => 'prenotazioni.html', 'method' => 'post'], '{{select_campi}}{{select_fasce}}{{select_utente1}}{{select_utente2}}{{fields}}');
    $p['contenuto']['FORM'] = $form;


    # COSTRUZIONE SELECT (da sostituire poi con {{select_campi}}{{select_fasce}}{{fields}}{{utente1}}{{utente2}} )
        # select campi 
        $tendina_campi = '';
        foreach ($elenco_campi as $k => $v) {
            $tendina_campi .= Render\tag('option', ['value' => $v['nome_campo']], $v['nome_campo']);
        }
        $select_campi = Render\tag('select', ['name' => 'nome_campo'], $tendina_campi);
        $p['contenuto']['select_campi'] = $select_campi;
        
        # select con fasce orarie
        $tendina_fasce = '';
        foreach ($fasce as $k => $v) {
            $tendina_fasce .= Render\tag('option', ['value' => $v], $v);
        }
        $select_fasce = Render\tag('select', ['name' => 'orario'], $tendina_fasce);
        $p['contenuto']['select_fasce'] = $select_fasce;
        
        # select utenti (verrà inserita due volte in {{utente1}}{{utente2}})
        $tendina_utenti = '';
        foreach ($elenco_utenti as $id_utente => $dati_utente) { 
            $tendina_utenti .= Render\tag('option', ['value' => $id_utente], $dati_utente['nome'] . ' ' . $dati_utente['cognome']);
        }
        $select_utente1 = Render\tag('select', ['name' => 'utente1'], $tendina_utenti);
        $select_utente2 = Render\tag('select', ['name' => 'utente2'], $tendina_utenti);
        $p['contenuto']['select_utente1'] = $select_utente1;
        $p['contenuto']['select_utente2'] = $select_utente2;
                
                
    # COSTRUZIONE CAMPI INPUT    
    $tag_input = '';
    foreach($input_prenotazioni_attributi as $k => $v) {
        $tag_input .= Render\tag('input', $v);
    }
    $p['contenuto']['fields'] = $tag_input;
    
    
    # COSTRUZIONE TABELLA
    $p['contenuto']['table'] = Render\build_tab($database_prenotazioni, 'prenotazioni');