<?php

    require_once 'lib/registro.php';
    require_once 'lib/render.php';

    ######## SCRITTURA DATI #################

    ## inserisco la lista del database dentro una variabile
    $registro = Registro\lista();

    ## aggiunta di nominativi nel registro dell'albergo
    if (isset($_POST['nome']) && !empty($_POST['nome']) && isset($_POST['telefono']) && !empty($_POST['telefono']) && isset($_POST['camera']) && !empty($_POST['camera']) && isset($_POST['id']) && empty($_POST['id'])) 
        {
            Registro\aggiungi($_POST['nome'], $_POST['telefono'], $_POST['camera']);
        }

    ######## MODIFICA DATI  #################

    ## per modificare i valori dei campi, li popolo con i dati precedenti presenti in database
    if (isset($_GET['edit_id']) && !empty($_GET['edit_id'])) 
        {
            $value_input['{{val_id}}'] = $_GET['edit_id'];
            $value_input['{{val_nome}}'] = $registro[$_GET['edit_id']]['nome'];
            $value_input['{{val_telefono}}'] = $registro[$_GET['edit_id']]['telefono'];
            $value_input['{{val_camera}}'] = $registro[$_GET['edit_id']]['camera'];  
        }

    ## se i campi sono settati, modifichiamo il database
    if (isset($_POST['nome']) && !empty($_POST['nome']) && isset($_POST['telefono']) && !empty($_POST['telefono']) && isset($_POST['camera']) && !empty($_POST['camera']) && isset($_POST['id']) && !empty($_POST['id'])) 
        {
            Registro\modifica($_POST['id'], $_POST['nome'], $_POST['telefono'], $_POST['camera']);
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
    $righe_tabella = [];
    foreach ($registro as $k => $value) 
        {
            $campi = [];
            $campi[] = Render\tag('td', [], $k);

            foreach ($value as $k2 => $v2)
                {
                    $campi[] = Render\tag('td', [], $v2);
                }

            $campi[] = Render\tag('td', [], Render\tag('a', ['href' => 'index.html?edit_id=' .$k], 'Modifica'));
            $campi[] = Render\tag('td', [], Render\tag('a', ['href' => 'index.html?delete_id=' .$k], 'Elimina')); 
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

    