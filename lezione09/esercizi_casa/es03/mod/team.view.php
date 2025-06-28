<?php

    # 
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
            'value' => isset($_GET['edit_id']) && !empty($_GET['edit_id']) ? $elenco_team[$_GET['edit_id']]['nome_team'] : '',
            '' => 'required',
        ),

        'submit' => array(
            'type' => 'submit',
            'value' => 'Inserisci',
        ),
    );

    # COSTRUZIONE CAMPI INPUT    
    $tag_input = '';
    foreach($input_team_attributi as $k => $array_campi) {

        $tag_input .= Render\tag('input', $array_campi);
    }

    # COSTRUZIONE TABELLA
    $elenco_team = Team\lista();
    $righe_tabella = []; 
    foreach ($elenco_team as $k => $value) 
    {
        $campi = []; 
            $campi[] = Render\tag('td', [], $k);
            foreach ($value as $k2 => $v2) {
                $campi[] = Render\tag('td', [], $v2);
            }  

            #aggiungo i tasti 'modifica' ed 'elimina'
            $campi[] = Render\tag('td', [], Render\tag('a', ['href' => '?edit_id=' .$k], 'Modifica'));
            $campi[] = Render\tag('td', [], Render\tag('a', ['href' => '?delete_id=' .$k], 'Elimina')); 

            #implodo in stringa l'array $campi contenente i tag <td>, aggiungo ogni stringa del ciclo main dentro un tag <tr> in modo da ottenere le righe di tabella
            $righe_tabella[] = Render\tag('tr', [], implode($campi));
    }

    # RENDERING FINALE
    $render = file_get_contents('tpl/main.html');
    $render = str_replace('{{titolo}}', 'Lista Team', $render);
    $render = str_replace('Elenco Team, piloti e punteggio:', 'Elenco Team:', $render);
    $render = str_replace('{{action}}', 'lista_team.html', $render);

    #elimina select
    $render = str_replace('{{select}}', '', $render);

    $render = str_replace('{{form}}', $tag_input, $render);
    $render = str_replace('="required"', 'required', $render);

        if ($righe_tabella == []) 
            { $table = '';} 
        else 
            { $table = Render\tag('table', ['border' => 1], implode($righe_tabella));}
    
    $render = str_replace('{{table}}', $table, $render);
    echo $render;