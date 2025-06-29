<?php

    $database_prenotazioni = Prenotazioni\lista();
    $elenco_utenti = Utenti\lista();
    
    # INSERIMENTO DATI (PRENOTAZIONI)
    if (isset($_POST['nome_campo']) && !empty($_POST['nome_campo']) 
        && isset($_POST['data']) && !empty($_POST['data'])
        && isset($_POST['orario']) && !empty($_POST['orario'])
        && isset($_POST['utente1']) && !empty($_POST['utente1'])
        && isset($_POST['utente2']) && !empty($_POST['utente2'])
        && isset($_POST['id']) && empty($_POST['id'])) 
        {
            $a = Prenotazioni\overbooking($_POST['nome_campo'], $_POST['data'], $_POST['orario'], $_POST['id']);
            if ($a === false) {
                echo "Prenotazione respinta!";
            } else {
                Prenotazioni\aggiungi(
                    $_POST['nome_campo'], 
                    $_POST['data'], 
                    $_POST['orario'], 
                    $elenco_utenti[$_POST['utente1']]['nome'] . ' ' . $elenco_utenti[$_POST['utente1']]['cognome'], 
                    $elenco_utenti[$_POST['utente2']]['nome'] . ' ' . $elenco_utenti[$_POST['utente2']]['cognome']
                );
            }
        } 

    # MODIFICA DATI
    if (isset($_POST['nome_campo']) && !empty($_POST['nome_campo'])
        && isset($_POST['data']) && !empty($_POST['data'])
        && isset($_POST['orario']) && !empty($_POST['orario'])
        && isset($_POST['utente1']) && !empty($_POST['utente1'])
        && isset($_POST['utente2']) && !empty($_POST['utente2'])
        && isset($_POST['id']) && !empty($_POST['id']))  
        {
            $a = Prenotazioni\overbooking($_POST['nome_campo'], $_POST['data'], $_POST['orario'], $_POST['id']);
            if ($a === false) {
                echo "Prenotazione respinta!";
            } else {
                Prenotazioni\modifica(
                    $_POST['id'], 
                    $_POST['nome_campo'], 
                    $_POST['data'], 
                    $_POST['orario'], 
                    $elenco_utenti[$_POST['utente1']]['nome'] . ' ' . $elenco_utenti[$_POST['utente1']]['cognome'], 
                    $elenco_utenti[$_POST['utente2']]['nome'] . ' ' . $elenco_utenti[$_POST['utente2']]['cognome']
                );
            }
        }  
        
    # ELIMINA DATI
    if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) 
        {
            Prenotazioni\elimina($_GET['delete_id']);
        }