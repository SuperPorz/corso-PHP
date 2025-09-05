<?php

    try {
        # INCLUDES
        include 'classes/DatabaseConnection.php';
        include 'inc/pagine.php';
        include 'classes/DatabaseTable.php';
        include 'classes/Officina.php';


        # ISTANZE
        $tab_intervento = new DatabaseTable($pdo, 'intervento', 
            'id_interv');
        $officina = new Officina($tab_intervento);


        # CONTROLLER INTERVENTI AUTO
        # inserimento intervento su auto
        if (isset($_POST['targa']) && isset($_POST['lavorazione'])
            && isset($_POST['operatore']) && isset($_POST['tempo'])
            && isset($_POST['costo_h'])) {

                $officina->inserisci_lavorazione($_POST['targa'],
                    $_POST['lavorazione'], $_POST['operatore'],
                    $_POST['tempo'], $_POST['costo_h']);
        }

        # eliminazione record intervento su auto
        if (isset($_GET['id_interv']) && $_GET['azione'] == 'elimina') {
            $officina->elimina_intervento($_GET['id_interv']);
            header('Location: officina.html');
        }


        # VISUALIZZAZIONE DATI (inserimento nell'array pagine)
        #tabella1: STORICO GLOBALE
        $righe_tabella1 = [];
        foreach($officina->lista_interventi_registrati() as $intervento) {

            $righe_tabella1[] = $officina->render('tpl/tables/officina.storico.table.list.html', 
            [
                'id_interv' => $intervento['id_interv'],
                    'targa' => $intervento['targa'],
                    'lavorazione' => $intervento['lavorazione'],
                    'operatore' => $intervento['operatore'],
                    'tempo' => $intervento['tempo'],
                    'costo_h' => $intervento['costo_h'] .' €',
                    'costo_tot' => number_format($intervento['costo_h'] * $intervento['tempo'], 
                        0, '.', "'") . ' <i>€</i>'
                ]
            );
        }
        $tabella1 = $officina->render('tpl/tables/officina.storico.table.html', 
        ['interventi_registrati' => implode($righe_tabella1)]);
        $p['contenuto']['tabella1'] = '<div class="table-container">' . $tabella1 . '</div>';

        #tabella2: STORICO PER TARGA
        if (isset($_POST['targa']) && isset($_POST['storico'])) {
                
            $righe_tabella2 = [];
            $costo_tot = 0;
            foreach($officina->storico_lavorazioni_targa($_POST['targa']) as $intervento) {

                $righe_tabella2[] = $officina->render('tpl/tables/officina.storico.table.list.html', 
                [
                    'id_interv' => $intervento['id_interv'],
                    'targa' => $intervento['targa'],
                    'lavorazione' => $intervento['lavorazione'],
                    'operatore' => $intervento['operatore'],
                    'tempo' => $intervento['tempo'],
                    'costo_h' => $intervento['costo_h'],
                    'costo_tot' => number_format($intervento['costo_h'] * $intervento['tempo'], 
                        0, '.', "'") . ' <i>€</i>'
                    ]
                );
                $costo_tot += $intervento['tempo'] * $intervento['costo_h'];
            }
            $tabella2 = $officina->render('tpl/tables/officina.storico.table.html', 
            ['interventi_registrati' => implode($righe_tabella2)]);
            $p['contenuto']['tabella2'] = $tabella2;
            $p['contenuto']['spesa_totale'] = number_format($costo_tot, 0, 
                '.', "'") . ' <i>€</i>';
        }
        
        #tabella3: BEST OPERATORI
        $righe_tabella3 = [];
        foreach($officina->migliori_operatori() as $operatore) {

            $righe_tabella3[] = $officina->render('tpl/tables/officina.calcoli.table3.list.html', 
                [
                    'operatore' => $operatore['operatore'],
                    'lavorazione' => $operatore['lavorazione'],
                    'tempo_migliore' => $operatore['tempo_migliore'] . ' <i>ore</i>',
                    ]
                );
        }
        $tabella3 = $officina->render('tpl/tables/officina.calcoli.table3.html', 
        ['migliori_operatori' => implode($righe_tabella3)]);
        $p['contenuto']['tabella3'] = $tabella3;

        #tabella4: TEMPI MEDI PER LAVORAZIONE
        $righe_tabella4 = [];
        foreach($officina->tempi_medi() as $lavorazione) {

            $righe_tabella4[] = $officina->render('tpl/tables/officina.calcoli.table4.list.html', 
                [
                    'lavorazione' => $lavorazione['lavorazione'],
                    'tempo_medio' => number_format($lavorazione['tempo_medio'], 0, 
                '.', "'") . ' <i>ore</i>'
                    ]
                );
        }
        $tabella4 = $officina->render('tpl/tables/officina.calcoli.table4.html', 
        ['tempi_medi' => implode($righe_tabella4)]);
        $p['contenuto']['tabella4'] = $tabella4;

        #tabella5: TEMPI MEDI PER LAVORAZIONE
        $righe_tabella5 = [];
        foreach($officina->lavorazioni_frequenti() as $lavorazione) {

            $righe_tabella5[] = $officina->render('tpl/tables/officina.calcoli.table5.list.html', 
                [
                    'lavorazione' => $lavorazione['lavorazione'],
                    'frequenza' => $lavorazione['frequenza'] . ' <i>volte</i>',
                    ]
                );
        }
        $tabella5 = $officina->render('tpl/tables/officina.calcoli.table5.html', 
        ['lavorazioni_frequenti' => implode($righe_tabella5)]);
        $p['contenuto']['tabella5'] = $tabella5;


        # RENDER FINALE
        $render = $officina->render($p['template'], $p['contenuto']);
        echo $render;

    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage() . ' in '
            . $e->getFile() . ':' . $e->getLine();
    }

    $pdo = null;