<?php

    $elenco_team = Team\lista();
    
    # INSERIMENTO DATI (TEAMS)
    if (isset($_POST['nome_team']) && !empty($_POST['nome_team']) 
        && isset($_POST['punteggio']) && !empty($_POST['punteggio'])
        && isset($_POST['id']) && empty($_POST['id'])) 
        {
            Team\aggiungi($_POST['nome_team'], $_POST['punteggio']);
        } 

    # MODIFICA DATI
    if (isset($_POST['nome_team']) && !empty($_POST['nome_team'])
        && isset($_POST['punteggio']) && !empty($_POST['punteggio'])
        && isset($_POST['id']) && !empty($_POST['id']))  
        {
            Team\modifica($_POST['id'], $_POST['nome_team'], $_POST['punteggio']);
        }  
        
    # ELIMINA DATI
    if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) 
        {
            Team\elimina($_GET['delete_id']);
        }