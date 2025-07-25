<?php

    # COSTRUZIONE TABELLA
        #creazione righe della TABELLA
        $righe_tabella = [];
        foreach(Crea_piatti\lista() as $piatto) {

            $righe_tabella[] = Funzioni\render('tpl/piatto.table.list.html', 
            
                [
                    'idp' => $piatto['idp'],
                    'nome_p' => $piatto['nome_p'],
                    'ingredienti' => $piatto['ingredienti'],
                ]
            );
        }

        #stringa HTML della tabella dentro variabile
        $tabella = Funzioni\render('tpl/piatto.table.html', ['lista_piatti' => implode($righe_tabella)]);

        #preparazione TABELLA per il render (aggiunta all'array pagine)
        $p['contenuto']['tabella'] = $tabella;
        
    
    # COSTRUZIONE FORM
        #creazione form
        $form = Funzioni\render('tpl/piatto.form.html', 
        
            [
                'azione' => ( $_REQUEST['azione'] == 'modifica' ) ? 'modifica' : 'aggiungi',
                'val_idp' => $_REQUEST['idp'] ?? '',
                'val_nome_p' => $_REQUEST['nome_p'] ?? "''"
            ]
        );
    
    
    # COSTRUZIONE LISTA INPUT INGREDIENTI

        #lista standard
        $options = '';
        foreach(Ingrediente\lista() as $k => $v) {

            $options .= "<br><input type=\"checkbox\" name=\"" .$v['idi'] ."\"". "id=\"" .$v['idi'] ."\"". "value=\"". $v['nome_i'] ."\"" . 'placeholder="'. $v['nome_i'] ."\"&nbsp>" . 
            "<label for=" .$v['idi'] ."\">" . $v['nome_i'] . "</label>";
        }
        $form = str_replace('{{ingredienti_registrati}}', $options, $form);

        #lista con flag attive sugli ingredienti da modificare
        if ($_REQUEST['azione'] == 'modifica' && isset($_REQUEST['idp']) && !empty($_REQUEST['idp'])) {

            $dettagli_piatto = Crea_piatti\dettagli($_REQUEST['idp']);
            $string_to_array = explode(';', trim($dettagli_piatto['ingredienti']));
            
            // Rimuovi l'ultimo elemento vuoto e pulisci gli spazi
            $ingredienti_piatto = array_filter(array_map('trim', $string_to_array));
            
            foreach($ingredienti_piatto as $ingrediente) {
                if (!empty($ingrediente)) {
                    // Pattern più specifico per evitare sostituzioni multiple
                    $pattern_da_sostituire = 'value="' . $ingrediente . '"' . 'placeholder="' . $ingrediente . '"&nbsp>';
                    $pattern_sostituzione = 'value="' . $ingrediente . '"' . 'placeholder="' . $ingrediente . '" checked &nbsp;';
                    
                    $form = str_replace($pattern_da_sostituire, $pattern_sostituzione, $form);
                }
            }
        }
        
        #preparazione per il render finale
        $p['contenuto']['form'] = $form;