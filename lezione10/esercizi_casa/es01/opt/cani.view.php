<?php

    # COSTRUZIONE TABELLA
        #creazione righe della TABELLA
        $righe_tabella = [ ];
        foreach(Cani\lista() as $cane) {
            $righe_tabella[] = Funzioni\render('tpl/cani.table.lista.html', 

          [
                    'id_c' => $cane['id_c'],
                    'nome' => $cane['nome'],
                    'data_n' => $cane['data_n'],
                    'data_v' => $cane['data_v'],
                ]        
            );
        }

        #creazione della TABELLA
        $tabella = Funzioni\render('tpl/cani.table.html', ['lista_tabella' => implode($righe_tabella)]);

        #preparazione TABELLA per il render (aggiunta all'array pagine)
        $p['contenuto']['table'] = $tabella;


    # COSTRUZIONE FORM
        #crezione del FORM
        $form = Funzioni\render('tpl/cani.form.html',
    [
                'azione' => ( $_REQUEST['azione'] == 'modifica' ) ? 'modifica' : 'aggiungi',
                'val_id_c' => $_REQUEST['id_c'] ?? '',
                'val_nome' => $_REQUEST['nome'] ?? "''",
                'val_data_n' => $_REQUEST['data_n'] ?? '',
                'val_data_v' => $_REQUEST['data_v'] ?? '',
            ]
        );

        #preparazione FORM per il render (aggiunta all'array pagine)
        $p['contenuto']['form'] = $form;     

        

        