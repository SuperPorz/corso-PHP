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
