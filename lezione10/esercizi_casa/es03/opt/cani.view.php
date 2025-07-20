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
                    'id_p' => $cane['id_p'],
                    'nome_p' => $cane['nome_p'],
                ]        
            );
        }

        #creazione della TABELLA
        $tabella = Funzioni\render('tpl/cani.table.html', ['lista_tabella' => implode($righe_tabella)]);

        #preparazione TABELLA per il render (aggiunta all'array pagine)
        $p['contenuto']['table'] = $tabella;


    # COSTRUZIONE DELLA SELECT
        $x = file_get_contents('tpl/padroni.select.html');
        $options = '';
        foreach(Padroni\lista() as $k => $v) {
            $options .= "<option value=\"" .$v['id_p'] . "\">" . $v['nome_p'] . "</option>";
        }
        $x = str_replace('{{lista_select}}', $options, $x);
        $p['contenuto']['select'] = $x;


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