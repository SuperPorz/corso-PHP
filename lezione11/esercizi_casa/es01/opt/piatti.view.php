<?php

    # COSTRUZIONE TABELLA
        #creazione righe della TABELLA
        $righe_tabella = [];
        foreach(Piatti\lista() as $piatto) {

            $righe_tabella[] = Funzioni\render('tpl/piatti.table.list.html', 
            
                [
                    'idp' => $piatto['idp'],
                    'nome_p' => $piatto['nome_p'],
                    'ingredienti' => $piatto['ingredienti'],
                ]
            );
        }

        #stringa HTML della tabella dentro variabile
        $tabella = Funzioni\render('tpl/piatti.table.html', ['lista_piatti' => implode($righe_tabella)]);

        #preparazione TABELLA per il render (aggiunta all'array pagine)
        $p['contenuto']['tabella'] = $tabella;
        
    
    # COSTRUZIONE FORM
        #creazione form
        $form = Funzioni\render('tpl/piatti.form.html', 
        
            [
                'azione' => ( $_REQUEST['azione'] == 'modifica' ) ? 'modifica' : 'aggiungi',
                'val_idp' => $_REQUEST['idp'] ?? '',
                'val_nome_p' => $_REQUEST['nome_p'] ?? "''"
            ]
        );
    
    
    # COSTRUZIONE DELLA SELECT
        $options = '';
        foreach(Ingredienti\lista() as $k => $v) {

            $options .= "<br><input type=\"checkbox\" name=\"" .$v['idi'] ."\"". "id=\"" .$v['idi'] ."\"". "value=\"". $v['nome_i'] ."\"" . 'placeholder="'. $v['nome_i'] ."\">" . 
            "<label for=" .$v['idi'] ."\">" . $v['nome_i'] . "</label>";
        }
        $form = str_replace('{{select}}', $options, $form);
        $p['contenuto']['form'] = $form;