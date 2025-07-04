<?php

    # COSTRUZIONE TABELLA
        # creazione righe
        $righe = [];
        foreach(Log\lista() as $record_azione) {
            $righe[] = Funzioni\render('tpl/log.table.lista.html', 

          [
                    'id_log' => $record_azione['id_log'],
                    'azione' => $record_azione['azione'],
                    'id_p' => $record_azione['id_p'],
                    'nome_v' => $record_azione['nome_v'],
                    'nome_n' => $record_azione['nome_n'],
                    'cognome_v' => $record_azione['cognome_v'],
                    'cognome_n' => $record_azione['cognome_n'],
                    'numero_v' => $record_azione['numero_v'],
                    'numero_n' => $record_azione['numero_n'],
                    'data_az' => $record_azione['data_az'],
                    'ora_az' => $record_azione['ora_az'],
                ]
            );
        }

        #creazione tabella
        $lista_tabella = Funzioni\render('tpl/log.table.html', ['lista_tabella' => implode($righe)]);

    $p['contenuto']['table'] = $lista_tabella;


    # aggiungo un link al posto del FORM, PER CANCELLARE CRONOLOGIA
    $p['contenuto']['form'] = '<p><a href="log_operazioni.html?A=1">CANCELLA CRONOLOGIA</a></p>';