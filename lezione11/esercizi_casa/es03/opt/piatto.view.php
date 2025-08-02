<?php

    # COSTRUZIONE TABELLA
        #creazione righe della TABELLA
        $righe_tabella = [];
        foreach(Piatto\lista() as $piatto) {

            $righe_tabella[] = Funzioni\render('tpl/piatto.table.list.html', 
            
                [
                    'idp' => $piatto['idp'],
                    'nome_p' => $piatto['nome_p'],
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
        
        #preparazione per il render finale
        $p['contenuto']['form'] = $form;