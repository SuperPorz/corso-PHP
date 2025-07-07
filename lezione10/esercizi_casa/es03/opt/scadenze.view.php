<?php

    # COSTRUZIONE TABELLA
        #creazione righe della TABELLA
        $righe_tabella = [ ];
        foreach(Scadenze\scadenze() as $cane) {
            $righe_tabella[] = Funzioni\render('tpl/scadenze.table.lista.html', 

          [
                    'id_c' => $cane['id_c'],
                    'nome' => $cane['nome'],
                    'data_n' => $cane['data_n'],
                    'data_v' => $cane['data_v'],
                    'nome_p' => $cane['nome_p'],
                    'telefono' => $cane['telefono'],
                ]        
            );
        }

        #creazione della TABELLA
        $tabella = Funzioni\render('tpl/scadenze.table.html', ['lista_tabella' => implode($righe_tabella)]);

        #preparazione TABELLA per il render (aggiunta all'array pagine)
        $p['contenuto']['table'] = $tabella;


       

        

        