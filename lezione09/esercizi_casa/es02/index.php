<?php

    require_once 'lib/registro.php';
    require_once 'lib/render.php';

    ######## SCRITTURA DATI #################

    ## inserisco la lista del database dentro una variabile
    $registro = Registro\lista();

    ## aggiunta di nominativi nel registro dell'albergo
    if (isset($_POST['nome']) && !empty($_POST['nome']) 
        && isset($_POST['telefono']) && !empty($_POST['telefono']) 
        && isset($_POST['camera']) && !empty($_POST['camera']) 
        && isset($_POST['id']) && empty($_POST['id'])
        && isset($_POST['arrivo']) && !empty($_POST['arrivo'])
        && isset($_POST['partenza']) && !empty($_POST['partenza']))               
        {
            #con questa funzione, controllo l'overbooking; in caso di assenza di problemi, procede con la registrazione della prenotazione (funz. AGGIUNGI)
            $a = Registro\overbooking($_POST['camera'], $_POST['arrivo'], $_POST['partenza']);

            # se overbooking verificato, allora messagigo di errore. Altrimenti si procede con la prossima verifica
            if ($a === false) 
                { echo "Overbooking! Camera già prenotata nel periodo indicato."; } 
            else 
                {
                    # controlliamo che 'data arrivo' sia < 'data partenza'
                    if (date($_POST['arrivo']) >= date($_POST['partenza']))
                        { echo "La data di arrivo in albergo è successiva alla data di partenza! Inserire una data valida."; } 
                    else 
                        { Registro\aggiungi($_POST['nome'], $_POST['telefono'], $_POST['camera'], $_POST['arrivo'], $_POST['partenza']); }
                }
        }

    ######## MODIFICA DATI  #################

    ## per modificare i valori dei campi, li popolo con i dati precedenti presenti in database
    if (isset($_GET['edit_id']) && !empty($_GET['edit_id'])) 
        {
            $value_input['{{val_id}}'] = $_GET['edit_id'];
            $value_input['{{val_nome}}'] = $registro[$_GET['edit_id']]['nome'];
            $value_input['{{val_telefono}}'] = $registro[$_GET['edit_id']]['telefono'];
            $value_input['{{val_camera}}'] = $registro[$_GET['edit_id']]['camera'];
            $value_input['{{val_arrivo}}'] = $registro[$_GET['edit_id']]['arrivo'];
            $value_input['{{val_partenza}}'] = $registro[$_GET['edit_id']]['partenza'];  
        }

    ## se i campi sono settati, modifichiamo il database
    if (isset($_POST['nome']) && !empty($_POST['nome']) 
        && isset($_POST['telefono']) && !empty($_POST['telefono']) 
        && isset($_POST['camera']) && !empty($_POST['camera']) 
        && isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['arrivo']) && !empty($_POST['arrivo'])
        && isset($_POST['partenza']) && !empty($_POST['partenza'])) 
        {
            $a = Registro\overbooking($_POST['camera'], $_POST['arrivo'], $_POST['partenza'], $_POST['id']);

            if ($a === false) {
                echo "Overbooking! Camera già prenotata nel periodo indicato.";
            } else {
                Registro\modifica($_POST['id'], $_POST['nome'], $_POST['telefono'], $_POST['camera'], $_POST['arrivo'], $_POST['partenza']);          
            }      
        }

    ######## ELIMINA DATI  #################

    ## con la funz. elimina, tolgo dal database l'id che mi viene passato con gET (tramite click del link elimina di fianco al record)
    if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) 
        {
            Registro\elimina($_GET['delete_id']);
        }


    ######## RENDERING  #################

    ## aggiorniamo la lista contentuta dalla variabile (dopo eventuali modifiche)
    $registro = Registro\lista();

    #se nulla è settato, la pagina default è index.html gestita da htaccess
    if (!isset($_REQUEST['p']) || $_REQUEST['p'] != 'index') 
        {
            $_REQUEST['p'] = 'index';
        }
    
    #costruisco la tabella del registro dell'albergo
    $righe_tabella = []; #inizializzo la lista delle righe come vuota
    foreach ($registro as $k => $value) #ciclo main del registro d'albergo per inserire i dati in una tabella HTML
        {
            
            $campi = []; #inizializzo la lista campi come vuota
            $campi[] = Render\tag('td', [], $k); #inserisco nella prima cella, l'id utente 

            //se partenza <= oggi, cicla tutti i campi escluso quello con chiave "partenza", quest'ultimo lo tratto a parte per colorarlo di rosso (fuori dal ciclo)
            if (date($value['partenza']) <= date('Y-m-d')) { 
                foreach ($value as $k2 => $v2){
                    if ($k2 === 'partenza') {
                        continue; //salto iterazione della chiave 'partenza'
                    } 
                    $campi[] = Render\tag('td', [], $v2); //aggiungo dentro $campi, un tag <td> con il valore corrente di $v2 dell'iterazione
                }                    
                $campi['partenza'] = Render\tag('td', ["style" => "background-color:tomato; color:white"], $value['partenza']); //coloro di rosso solo la cella 'partenza'
            }

            //altrimenti, ciclo normalmente tutti gli elementi dell'array del registro inserirendoli nei <td> (stavolta nessuna chiave vien esclusa)
            else { 
                foreach ($value as $k2 => $v2) { 
                    $campi[] = Render\tag('td', [], $v2); 
                }
            }

            #aggiungo i tasti 'modifica' ed 'elimina'
            $campi[] = Render\tag('td', [], Render\tag('a', ['href' => 'index.html?edit_id=' .$k], 'Modifica'));
            $campi[] = Render\tag('td', [], Render\tag('a', ['href' => 'index.html?delete_id=' .$k], 'Elimina')); 

            #implodo in stringa l'array $campi contenente i tag <td>, aggiungo ogni stringa del ciclo main dentro un tag <tr> in modo da ottenere le righe di tabella
            $righe_tabella[] = Render\tag('tr', [], implode($campi));
        }

    #rendering finale
    $render = 'tpl/main.html';
    $render = Render\render($render, $value_input);

        if ($righe_tabella == []) 
            { $table = '';} 
        else 
            { $table = Render\tag('table', ['border' => 1], implode($righe_tabella));}
    
    $render = str_replace('{{table}}', $table, $render);
    echo $render;

    

    # for ($i=0; $i<=(count($value)-1); $i++)