<?php

    # COSTRUZIONE TABELLA
        #creazione righe della TABELLA
        $righe_tabella = [];
        foreach(Uso_ingrediente\lista() as $piatto) {

            $righe_tabella[] = Funzioni\render('tpl/uso_ingrediente.table.list.html', 
            
                [
                    'idi' => $piatto['idi'],
                    'nome_i' => $piatto['nome_i'],
                    'piatti' => $piatto['piatti'],
                ]
            );
        }

        #stringa HTML della tabella dentro variabile
        $tabella = Funzioni\render('tpl/uso_ingrediente.table.html', ['visualizza_ingredienti' => implode($righe_tabella)]);

        #preparazione TABELLA per il render (aggiunta all'array pagine)
        $p['contenuto']['tabella'] = $tabella;