<?php

    # COSTRUZIONE TABELLA
        #creazione righe della TABELLA
        $righe_tabella = [];
        foreach(Piatti\lista() as $piatto) {

            $righe_tabella[] = Funzioni\render('tpl/piatti.table.list.html', 
            
                [
                    'idp' => $piatto['idp'],
                    'nome_p' => $piatto['nome_p'],
                    'idi' => $piatto['idi'],
                    'nome_i' => $piatto['nome_i'],
                ]
            );
        }

        #stringa HTML della tabella dentro variabile
        $tabella = Funzioni\render('tpl/piatti.table.html', ['lista_piatti' => implode($righe_tabella)]);

        #preparazione TABELLA per il render (aggiunta all'array pagine)
        $p['contenuto']['tabella'] = $tabella;


    # COSTRUZIONE DELLA SELECT
        $x = file_get_contents('tpl/piatti.form.select.html');
        $options = '';
        foreach(Ingredienti\lista() as $k => $v) {

            $options .= "<option value=\"" .$v['idi'] . "\">" . $v['nome_i'] . "</option>";
        }
        $x = str_replace('{{ingredienti_registrati}}', $options, $x);
        $p['contenuto']['select'] = $x;
        
    
    
    # COSTRUZIONE FORM
        #creazione form
        $form = Funzioni\render('tpl/piatti.form.html', 
        
            [
                'azione' => ( $_REQUEST['azione'] == 'modifica' ) ? 'modifica' : 'aggiungi',
                'val_idp' => $_REQUEST['idp'] ?? '',
                'val_nome_p' => $_REQUEST['nome_p'] ?? "''"
            ]
        );

        #preparazione TABELLA per il render (aggiunta all'array pagine)
        $p['contenuto']['form'] = $form;