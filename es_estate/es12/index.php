<?php

    try {
        # INCLUDES
        include 'inc/DatabaseConnection.php';
        include 'inc/functions.php';
        include 'inc/pagine.php';
        include 'classes/DatabaseTable.php';
        include 'classes/Lavorazione.php';
        include 'classes/Operatore.php';
        include 'classes/Officina.php';

        # ISTANZE
        # istanze tabelle
        $tab_operatore = new DatabaseTable($pdo, 'operatore', 'id_operat');
        $tab_lavorazione = new DatabaseTable($pdo, 'lavorazione', 'id_lavoraz');
        $tab_tempi_operatore = new DatabaseTable($pdo, 'tempi_per_operatore', 
                                                'id_tempi');
        $tab_intervento = new DatabaseTable($pdo, 'intervento', 'id_interv');

        # istanza main program OFFICINA
        $officina = new Officina($tab_tempi_operatore, $tab_intervento);


        # INSERIMENTO DATI
        # inserimento operatore
        if (isset($_POST['nome'])) {
            $operatore = new Operatore($tab_operatore, $_POST['nome']);
            $operatore->inserisci_operatore();
        }

        # inserimento lavorazione
        if (isset($_POST['descrizione']) && isset($_POST['costo_h'])) {
            $lavorazione = new Lavorazione($tab_lavorazione, 
                $_POST['descrizione'], $_POST['costo_h']);
            
                $lavorazione->inserisci_lavorazione();
        }

        # inserimento tempi_per_operatore
        if (isset($_POST['id_lavoraz']) && isset($_POST['id_operat'])
            && isset($_POST['tempo'])) {

                $officina->inserisci_tempi_per_operatore(
                    $_POST['descrizione'],
                    $_POST['id_operat'], $_POST['tempo']);
        }

        # inserimento intervento su auto
        if (isset($_POST['targa']) && isset($_POST['id_lavoraz'])
            && isset($_POST['id_operat'])) {

                $officina->richiesta_lavorazione($_POST['targa'],
                    $_POST['id_lavoraz'], $_POST['id_operat']);
        }


        # ELIMINAZIONE DATI
        # eliminazione lavorazione
        if (isset($_GET['id_lavoraz']) && $_GET['azione'] == 'elimina') {
            $tab_lavorazione->delete($_GET['id_lavoraz']);
            header('Location: lavorazioni.html');
        }

        # eliminazione operatore
        if (isset($_GET['id_operat']) && $_GET['azione'] == 'elimina') {
            $tab_operatore->delete($_GET['id_operat']);
            header('Location: operatori.html');
        }

        # eliminazione record tempi_per_operatore
        if (isset($_GET['id_tempi']) && $_GET['azione'] == 'elimina') {
            $officina->elimina_tempi_operatore($_GET['id_tempi']);
            header('Location: officina.html');
        }

        # eliminazione record intervento su auto
        if (isset($_GET['id_tempi']) && $_GET['azione'] == 'elimina') {
            $officina->elimina_intervento($_GET['id_tempi']);
            header('Location: officina.html');
        }


        # VISUALIZZAZIONE DATI (inserimento nell'array pagine)
        # pagina lavorazioni
        if ($_REQUEST['p'] == 'lavorazioni') {
            $righe_tabella = [];
            foreach($tab_lavorazione->find_all() as $lavorazione) {

                $righe_tabella[] = Funzioni\render('tpl/lavorazioni.table.list.html', 
                [
                    'id_lavoraz' => $lavorazione['id_lavoraz'],
                    'descrizione' => $lavorazione['descrizione'],
                    'costo_h' => $lavorazione['costo_h'],
                    ]
                );
            }
            #stringa HTML della tabella dentro variabile
            $tabella = Funzioni\render('tpl/lavorazioni.table.html', 
            ['lavorazioni_registrate' => implode($righe_tabella)]);

            #preparazione TABELLA per il render (aggiunta all'array pagine)
            $p['contenuto']['tabella'] = $tabella;
        }

        # pagina operatori
        if ($_REQUEST['p'] == 'operatori') {

                #tabella1 (elenco operatori)
                $righe_tabella1 = [];
                foreach($tab_operatore->find_all() as $operatore) {

                    $righe_tabella1[] = Funzioni\render('tpl/operatori.table1.list.html', 
                    [
                        'id_operat' => $operatore['id_operat'],
                        'nome' => $operatore['nome'],
                        ]
                    );
                }
                #stringa HTML della tabella dentro variabile
                $tabella1 = Funzioni\render('tpl/operatori.table1.html', 
                ['operatori_registrati' => implode($righe_tabella1)]);

                #preparazione TABELLA per il render (aggiunta all'array pagine)
                $p['contenuto']['tabella1'] = $tabella1;

                
                #tabella2 (tempistiche per operaio)
                $righe_tabella2 = [];
                foreach($officina->findAll_tempi_per_operatore() as $t_operatore) {

                    $righe_tabella2[] = Funzioni\render('tpl/operatori.table2.list.html', 
                    [
                        'id_tempi' => $t_operatore['id_tempi'],
                        'nome' => $t_operatore['nome'],
                        'descrizione' => $t_operatore['descrizione'],
                        'tempo' => $t_operatore['tempo']
                        ]
                    );
                }
                #stringa HTML della tabella dentro variabile
                $tabella2 = Funzioni\render('tpl/operatori.table2.html', 
                ['tempistiche_registrate' => implode($righe_tabella2)]);

                #preparazione TABELLA per il render (aggiunta all'array pagine)
                $p['contenuto']['tabella2'] = $tabella2;


        }

        # CALCOLI
        # lista lavorazioni svolte e spesa totale
        if (isset($_POST['targa']) && $_GET['azione'] == 'storico') {
            $lista_lavoraz = [];
            $spesa_totale = 0;

            $lista_lavoraz = $officina->storico_lavorazioni($_POST['targa']);
            $spesa_totale = $officina->costi_totali($_POST['targa']);
        }

        # tempi migliori operatori, tempi medi, lavorazioni più richieste
        $tempi_migliori = [];
        $tempi_medi = [];
        $top_lavorazioni = [];

        $tempi_migliori = $officina->migliori_operatori();
        $tempi_medi = $officina->tempi_medi();
        $top_lavorazioni = $officina->lavorazioni_frequenti();

        

        # RENDER FINALE
        $render = Funzioni\render($p['template'], $p['contenuto']);
        echo $render;

    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage() . ' in '
            . $e->getFile() . ':' . $e->getLine();
    }

    $pdo = null;