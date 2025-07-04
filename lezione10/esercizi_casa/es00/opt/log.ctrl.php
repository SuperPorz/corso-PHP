<?php


#se '$_REQUEST['azione']' non è settato, lo imposto su 'aggiungi'
if (!isset($_REQUEST['azione']) || empty($_REQUEST['azione'])) {
    $_REQUEST['azione'] = 'aggiungi';
}

# LOGICA DI ELIMINAZIONE DI OPERAZIONE ESEGUITA SUL DATABASE
if (isset($_REQUEST['id_p'])) 
{  
    $risultato = Log\elimina_singolo($_REQUEST['id_p']);
    if ($risultato) {
        
        // Reindirizza dopo l'eliminazione
        header('Location: log_operazioni.html');
        exit;
    }
}

# LOGICA DI PULIZIA DELLA CRONOLOGIA
if (isset($_GET['A']) && $_GET['A'] == 1) {
    Log\elimina_tutto();
}