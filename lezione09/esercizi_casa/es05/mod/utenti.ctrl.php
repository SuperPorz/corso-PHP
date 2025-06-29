<?php

    $database_utenti = Utenti\lista();

    # INSERIMENTO DATI (Utenti)
    if (isset($_POST['nome']) && !empty($_POST['nome']) 
        && isset($_POST['cognome']) && !empty($_POST['cognome'])  
        && isset($_POST['id']) && empty($_POST['id'])) 
        {
            Utenti\aggiungi($_POST['nome'], $_POST['cognome']);
        } 

    # MODIFICA DATI
    if (isset($_POST['nome']) && !empty($_POST['nome']) 
        && isset($_POST['cognome']) && !empty($_POST['cognome'])  
        && isset($_POST['id']) && !empty($_POST['id']))  
        {
            Utenti\modifica($_POST['id'], $_POST['nome'], $_POST['cognome']);
        }  

    # ELIMINA DATI
    if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) 
        {
            Utenti\elimina($_GET['delete_id']);
        }

        
    
    