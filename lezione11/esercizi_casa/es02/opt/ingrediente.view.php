<?php

    # COSTRUZIONE TABELLA
        #creazione righe tabella
        $righe_tabella = [];
        foreach(Ingrediente\lista() as $ingrediente) {
            $righe_tabella[] = Funzioni\render('tpl/ingrediente.table.list.html', 
            
                [
                    'idi' => $ingrediente['idi'],
                    'nome_i' => $ingrediente['nome_i'],
                ]
                );
        }

        #stringa HTML della tabella dentro variabile
        $tabella = Funzioni\render('tpl/ingrediente.table.html', ['lista_ingredienti' => implode($righe_tabella)]);

        #preparazione TABELLA per il render (aggiunta all'array pagine)
        $p['contenuto']['tabella'] = $tabella;


    # COSTRUZIONE FORM
        #creazione form
        $form = Funzioni\render('tpl/ingrediente.form.html', 
        
            [
                'azione' => ( $_REQUEST['azione'] == 'modifica' ) ? 'modifica' : 'aggiungi',
                'val_idi' => $_REQUEST['idi'] ?? '',
                'val_nome_i' => $_REQUEST['nome_i'] ?? "''"
            ]
        );

        #preparazione TABELLA per il render (aggiunta all'array pagine)
        $p['contenuto']['form'] = $form;




