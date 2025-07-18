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
        $tabella = Funzioni\render('tpl/umani.table.html', ['lista_tabella' => implode($righe)]);

    $p['contenuto']['table'] = $tabella;


    # COSTRUZIONE FORM
    $form = Funzioni\render('tpl/umani.form.html', 
  [
            'azione' => ( $_REQUEST['azione'] == 'modifica' ) ? 'modifica' : 'aggiungi', 
            'val_id_p' => isset($_REQUEST['id_p']) && isset($_GET['azione']) && $_GET['azione'] == 'modifica' ? $_REQUEST['id_p'] : '',
            'val_nome' => isset($_REQUEST['nome']) && isset($_GET['azione']) && $_GET['azione'] == 'modifica' ? $_REQUEST['nome'] : '',
            'val_cognome' => isset($_REQUEST['cognome']) && isset($_GET['azione']) && $_GET['azione'] == 'modifica' ? $_REQUEST['cognome'] : '',
            'val_numero' => isset($_REQUEST['numero']) && isset($_GET['azione']) && $_GET['azione'] == 'modifica' ? $_REQUEST['numero'] : ''
        ]);

    $p['contenuto']['form'] = $form;

