<?php

    # COSTRUZIONE TABELLA
        $righe_tabella = [];
        foreach($_POST as $k => $v) {
            if (is_numeric($k)) {
                $idi = intval($k);
                $ingrediente = Piatti_preparabili\ingrediente_scelto($idi);
                
                if ($ingrediente && is_array($ingrediente)) {
                    $righe_tabella[] = Funzioni\render('tpl/uso_ingrediente.table.list.html', [
                        'idi' => $ingrediente['idi'],
                        'nome_i' => $ingrediente['nome_i'],
                        'piatti' => $ingrediente['piatti'],
                    ]);
                }
            }
        }

    
        #stringa HTML della tabella dentro variabile
        $tabella = Funzioni\render('tpl/uso_ingrediente.table.html', ['visualizza_ingredienti' => implode($righe_tabella)]);

        #preparazione TABELLA per il render (aggiunta all'array pagine)
        $p['contenuto']['tabella'] = $tabella;
    
    
    # COSTRUZIONE FORM
        $form = file_get_contents('tpl/piatti_preparabili.form.html');
    
        # COSTRUZIONE LISTA INPUT INGREDIENTI
        #lista standard
        $options = '';
        foreach(Uso_ingrediente\lista() as $k => $v) {
            $options .= "<br><input type=\"checkbox\" name=\"" .$v['idi'] ."\" id=\"" .$v['idi'] ."\" value=\"". $v['nome_i'] ."\" placeholder=\"". $v['nome_i'] ."\" &nbsp;>" . 
            "<label for=\"" .$v['idi'] ."\">" . $v['nome_i'] . "</label>";
        }
        $form = str_replace('{{ingredienti_registrati}}', $options, $form);

        #lista con flag attive sugli ingredienti da modificare
        if (isset($_REQUEST['idp']) && !empty($_REQUEST['idp'])) {
            
            $dettagli_piatto = Crea_piatti\dettagli($_REQUEST['idp']);
            
            if (!empty($dettagli_piatto) && !empty($dettagli_piatto['ingredienti'])) {
                $string_to_array = explode(';', trim($dettagli_piatto['ingredienti']));
                
                // Rimuovi l'ultimo elemento vuoto e pulisci gli spazi
                $ingredienti_piatto = array_filter(array_map('trim', $string_to_array));
                
                foreach($ingredienti_piatto as $ingrediente) {
                    if (!empty($ingrediente)) {
                        // Pattern corretto che corrisponde all'HTML generato
                        $pattern_da_sostituire = 'value="' . $ingrediente . '" placeholder="' . $ingrediente . '" &nbsp;>';
                        $pattern_sostituzione = 'value="' . $ingrediente . '" placeholder="' . $ingrediente . '" checked &nbsp;>';
                        
                        $form = str_replace($pattern_da_sostituire, $pattern_sostituzione, $form);
                    }
                }
            }
        }
        
        #preparazione per il render finale
        $p['contenuto']['form'] = $form;