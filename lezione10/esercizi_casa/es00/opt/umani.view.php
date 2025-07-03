<?php

    # COSTRUZIONE TABELLA
        # creazione righe
        $righe = [];
        foreach(Umani\lista() as $umano) {
            $righe[] = Funzioni\render('tpl/umani.table.lista.html', 

          [
                    'id_p' => $umano['id_p'],
                    'nome' => $umano['nome'],
                    'cognome' => $umano['cognome'],
                    'numero' => $umano['numero'],
                ]
            );
        }

        #creazione tabella
        $lista_tabella = Funzioni\render('tpl/umani.table.html', ['lista_tabella' => implode($righe)]);

    $p['contenuto']['table'] = $lista_tabella;


    # COSTRUZIONE FORM
    $form = Funzioni\render('tpl/umani.form.html', 
  [
            'azione' => ( $_REQUEST['azione'] == 'modifica' ) ? 'modifica' : 'aggiungi', 
            'val_id_p' => $_REQUEST['id_p'] ?? '',
            'val_nome' => $_REQUEST['nome'] ?? '',
            'val_cognome' => $_REQUEST['cognome'] ?? '',
            'val_numero' => $_REQUEST['numero'] ?? ''
        ]);

    $p['contenuto']['form'] = $form;
