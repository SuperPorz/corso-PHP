<?php

    try {
        # INCLUDES
        include 'inc/DatabaseConnection.php';
        include 'inc/pagine.php';
        include 'inc/functions.php';
        include 'classes/database.php';
        include 'classes/officina.php';

        # ISTANZE
        # istanze tabelle
        $tab_operatore = new DatabaseTable($pdo, 'operatore', 'id_operat');
        $tab_lavorazione = new DatabaseTable($pdo, 'lavorazione', 'id_lavoraz');
        $tab_tempi_operatore = new DatabaseTable($pdo, 
            'tempi-per_operatore', 'id_tempi');
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
        if (isset($_POST['descrizione']) && isset($_POST['costo'])) {
            $lavorazione = new Lavorazione($tab_lavorazione, 
                $_POST['descrizione'], $_POST['costo']);
            
                $lavorazione->inserisci_lavorazione();
        }

        # inserimento tempi_per_operatore
        if (isset($_POST['id_lavoraz']) && isset($_POST['id_operat'])
            && isset($_POST['tempo'])) {

                $officina->tempi_per_operatore($_POST['descrizione'],
                    $_POST['id_operat'], $_POST['tempo']);            
        }

        # inserimento intervento su auto
        if (isset($_POST['targa']) && isset($_POST['id_lavoraz'])
            && isset($_POST['id_operat'])) {

                $officina->richiesta_lavorazione($_POST['targa'],
                    $_POST['id_lavoraz'], $_POST['id_operat']);            
        }

        # ELIMINAZIONE DATI
        # eliminazione operatore
        if (isset($_POST['id_operat']) && $_GET['action'] == 'elimina') {
            $tab_operatore->delete($_POST['id_operat']);
        }

        # eliminazione lavorazione
        if (isset($_POST['id_lavoraz']) && $_GET['action'] == 'elimina') {
            $tab_lavorazione->delete($_POST['id_olavoraz']);
        }

        # eliminazione record tempi_per_operatore
        if (isset($_POST['id_tempi']) && $_GET['action'] == 'elimina') {
            $officina->elimina_tempi_operatore($_POST['id_tempi']);
        }

        # eliminazione record intervento su auto
        if (isset($_POST['id_tempi']) && $_GET['action'] == 'elimina') {
            $officina->elimina_intervento($_POST['id_tempi']);
        }

        # CALCOLI
        # lista lavorazioni svolte e spesa totale
        if (isset($_POST['targa']) && $_GET['action'] == 'storico') {
            $lista_lavoraz = [];
            $spesa_totale = 0;

            $lista_lavoraz = $officina->storico_lavorazioni($_POST['targa']);
            $spesa_totale = $officina->costi_totali($_POST['targa']);
        }

        # tempi migliori operatori, tempi medi, lavorazioni più richieste
        $tempi_migliori = [];
        $tempi_medi = [];
        $top_lavorazioni = [];

        $tempi_migliori = $operatore->migliori_operatori();
        $tempi_medi = $lavorazione->tempi_medi();
        $top_lavorazioni = $lavorazione->lavorazioni_frequenti();


        

        # RENDER FINALE
        foreach($p['contenuto'] as $k) {
            $render = Funzioni\render($p['template'], $p['contenuto']);
        }
        echo $render;

    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage() . ' in '
            . $e->getFile() . ':' . $e->getLine();
    }

    $pdo = null;