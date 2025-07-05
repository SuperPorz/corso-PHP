<?php

    # COSTRUZIONE TABELLA
        #creazione righe della TABELLA
        $righe_tabella = [ ];
        foreach(Padroni\lista() as $padrone) {
            $righe_tabella[] = Funzioni\render('tpl/padroni.table.lista.html', 

          [
                    'id_p' => $padrone['id_p'],
                    'nome_p' => $padrone['nome_p'],
                ]        
            );
        }

        #creazione della TABELLA
        $tabella = Funzioni\render('tpl/padroni.table.html', ['lista_tabella' => implode($righe_tabella)]);

        #preparazione TABELLA per il render (aggiunta all'array pagine)
        $p['contenuto']['table'] = $tabella;


    # COSTRUZIONE FORM
        #crezione del FORM
        $form = Funzioni\render('tpl/padroni.form.html',
    [
                'azione' => ( $_REQUEST['azione'] == 'modifica' ) ? 'modifica' : 'aggiungi',
                'val_id_p' => $_REQUEST['id_p'] ?? '',
                'val_nome_p' => $_REQUEST['nome_p'] ?? "''",
            ]
        );

        #preparazione FORM per il render (aggiunta all'array pagine)
        $p['contenuto']['form'] = $form;     

        

        