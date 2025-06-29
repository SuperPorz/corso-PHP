<?php

    $database_campi = Campi\lista();

    # INSERIMENTO DATI (CAMPI)
    if (isset($_POST['nome_campo']) && !empty($_POST['nome_campo']) && isset($_POST['id']) && empty($_POST['id'])) 
        {
            Campi\aggiungi($_POST['nome_campo']);
        } 

    # MODIFICA DATI
    if (isset($_POST['nome_campo']) && !empty($_POST['nome_campo'])  && isset($_POST['id']) && !empty($_POST['id']))  
        {
            Campi\modifica($_POST['id'], $_POST['nome_campo']);
        }  

    # ELIMINA DATI
    if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) 
        {
            Campi\elimina($_GET['delete_id']);
        }

        
    
    