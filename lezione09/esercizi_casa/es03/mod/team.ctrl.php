<?php

    $elenco_piloti = Team\lista();
    
    # INSERIMENTO DATI (PILOTI)
    if (isset($_POST['nome_team']) && !empty($_POST['nome_team']) 
        && isset($_POST['id']) && empty($_POST['id'])) 
        {
            Team\aggiungi($_POST['nome_team']);
        } 

    # MODIFICA DATI

    if (isset($_POST['nome_team']) && !empty($_POST['nome_team']) 
        && isset($_POST['id']) && !empty($_POST['id']))  
        {
            Team\modifica($_POST['id'], $_POST['nome_team']);
        }  
        
    # ELIMINA DATI
    if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) 
        {
            Team\elimina($_GET['delete_id']);
        }