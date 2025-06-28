<?php

    $elenco_piloti = Piloti\lista();

    # INSERIMENTO DATI (PILOTI)
    if (isset($_POST['nome']) && !empty($_POST['nome']) 
        && isset($_POST['punteggio']) && !empty($_POST['punteggio']) 
        && isset($_POST['team']) && !empty($_POST['team']) 
        && isset($_POST['id']) && empty($_POST['id'])) 
        {
            Piloti\aggiungi($_POST['nome'], $_POST['punteggio'], $_POST['team']);
        } 

    # MODIFICA DATI

    if (isset($_POST['nome']) && !empty($_POST['nome']) 
        && isset($_POST['punteggio']) && !empty($_POST['punteggio']) 
        && isset($_POST['team']) && !empty($_POST['team']) 
        && isset($_POST['id']) && !empty($_POST['id']))  
        {
            Piloti\modifica($_POST['id'], $_POST['nome'], $_POST['punteggio'], $_POST['team']);
        }  

    # ELIMINA DATI
    if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) 
        {
            Piloti\elimina($_GET['delete_id']);
        }

        
    
    