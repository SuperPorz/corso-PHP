<?php

    # COSTRUZIONE TABELLA
        #creazione righe tabella
        $righe_tabella = [];
        foreach(Ingredienti\lista() as $ingrediente) {
            $righe_tabella[] = Funzioni\render('tpl/ingredienti.table.list.html', 
            
                [
                    'idi' => $ingrediente['idi'],
                    'nome_i' => $ingrediente['nome_i'],
                ]
                );
        }

        #stringa HTML della tabella dentro variabile
        $tabella = Funzioni\render('tpl/ingredienti.table.html', ['lista_ingredienti' => implode($righe_tabella)]);

        #preparazione TABELLA per il render (aggiunta all'array pagine)
        $p['contenuto']['tabella'] = $tabella;


    # COSTRUZIONE FORM
        #creazione form
        $form = Funzioni\render('tpl/ingredienti.form.html', 
        
            [
                'azione' => ( $_REQUEST['azione'] == 'modifica' ) ? 'modifica' : 'aggiungi',
                'val_idi' => $_REQUEST['idi'] ?? '',
                'val_nome_i' => $_REQUEST['nome_i'] ?? "''"
            ]
        );

        #preparazione TABELLA per il render (aggiunta all'array pagine)
        $p['contenuto']['form'] = $form;




