<?php

    # COSTRUZIONE CAMPI INPUT
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

    # COSTRUZIONE SELECT
    $team = Team\lista();
    $tendina = '';

    foreach ($team as $k => $value) {
        foreach ($value as $k2 => $v2) {

            $tendina .= Render\tag('option', ['value' => $v2], $v2);
        }
    }

    $select = Render\tag('select', ['name' => 'team'], $tendina);

    # COSTRUZIONE CAMPI INPUT
    $tag_input = '';

    foreach($input_piloti_attributi as $k => $array_campi) {

        $tag_input .= Render\tag('input', $array_campi);
    }
    
    # COSTRUZIONE TABELLA
    $elenco_piloti = Piloti\lista();
    $righe_tabella = []; 
    foreach ($elenco_piloti as $k => $value) 
    {
        $campi = []; 
            $campi[] = Render\tag('td', [], $k);
            foreach ($value as $k2 => $v2) {
                $campi[] = Render\tag('td', [], $v2);
            }  

            #aggiungo i tasti 'modifica' ed 'elimina'
            $campi[] = Render\tag('td', [], Render\tag('a', ['href' => 'index.html?edit_id=' .$k], 'Modifica'));
            $campi[] = Render\tag('td', [], Render\tag('a', ['href' => 'index.html?delete_id=' .$k], 'Elimina')); 

            #implodo in stringa l'array $campi contenente i tag <td>, aggiungo ogni stringa del ciclo main dentro un tag <tr> in modo da ottenere le righe di tabella
            $righe_tabella[] = Render\tag('tr', [], implode($campi));
        }


    # RENDERING FINALE    
    $render = file_get_contents('tpl/main.html');
    $render = str_replace('{{titolo}}', 'Lista Piloti', $render);
    $render = str_replace('{{action}}', 'lista_piloti.html', $render);
    

    $render = str_replace('{{select}}', $select, $render);
    $render = str_replace('{{form}}', $tag_input, $render);
    $render = str_replace('="required"', 'required', $render);

        if ($righe_tabella == []) 
            { $table = '';} 
        else 
            { $table = Render\tag('table', ['border' => 1], implode($righe_tabella));}
    
    $render = str_replace('{{table}}', $table, $render);
    echo $render;