<?php

    namespace Prenotazioni;
    
    # questa funzione apre e legge il contenuto restituendolo se esiste (se non esiste, lista vuota)
    function lista (){

        if (!file_exists('db/prenotazioni.db')) {
                return [];
            } 
        else {
                return unserialize(file_get_contents('db/prenotazioni.db'));
            }
    }

    # funzione di scrittura dei dati nel database
    function scrittura($array){

        $x = fopen('db/prenotazioni.db', 'w+');
        if ($x == true) 
            {
                fwrite($x, serialize($array));
                fclose($x);
                return true;
            } 
        else 
            {
                return false;
            }
    }

    # funzione di aggiunta dati al file database (usando poi la funzione di scrittura precedente)
    function aggiungi ($nome_campo, $data, $orario, $utente1, $utente2) {

        $database_prenotazioni = lista();
        $orario = $_POST['orario'];
        $id_prenotazione = md5('elenco'.microtime(true).rand(15, 5000)); // genero hash md5 standard
        $database_prenotazioni[$id_prenotazione] = 
            [
                'nome_campo' => $nome_campo,
                'data' => $data,
                'orario' => $orario,
                'coppia' => $utente1 . ' VS ' . $utente2, 
            ];

        scrittura($database_prenotazioni);
        return true;
    }

    # funzione di modifica dati del database (usando poi la funzione di scrittura precedente)
    function modifica ($id_prenotazione, $nome_campo, $data, $orario, $utente1, $utente2) {

        $database_prenotazioni = lista();
        if (isset($database_prenotazioni[$id_prenotazione])) 
            {
                $database_prenotazioni[$id_prenotazione] = 
                    [
                        'nome_campo' => $nome_campo,
                        'data' => $data,
                        'orario' => $orario,
                        'coppia' => $utente1 . ' VS ' . $utente2, 
                    ];
                scrittura($database_prenotazioni);
                return true;
            }
        else 
            {
                return false;
            }
    }

    # funzione di eliminazione dati del database
    function elimina ($id_prenotazione) {

        $database_prenotazioni = lista();
        if (isset($database_prenotazioni[$id_prenotazione])) 
            {
                unset($database_prenotazioni[$id_prenotazione]);
                scrittura($database_prenotazioni);
                return true;
            }
        else 
            { return false; } 
    }

    # funzione per la creazione del tag select
    function crea_select($lista_letta, $name_select, $campo_pagine_1, $campo_pagine_2 = '', $array_pagine){

        $tendina = '';
        foreach ($lista_letta as $k => $v) {

            $tendina .= tag('option', ['value' => $v], $v);
        }
        $select = tag('select', ['name' => $name_select], $tendina);
        $array_pagine['prenotazioni'][$campo_pagine_1] = $select;

        if ($campo_pagine_2 == '') {
            $array_pagine['prenotazioni'][$campo_pagine_2] = $select;
        }

        return true;
    }

    # funzione per la creazione dei tag HTML
    function tag($tag, $attr = [], $content = '') {
        
        $t = '<' . $tag;
        foreach ($attr as $key => $value) 
            {
                $t .= ' ' . $key . ( ( ! empty( $value ) ) ? '="' . htmlspecialchars($value) . '"' : '' );
            }
        $t .= '>';
        if( ! empty($content) ) 
            {
                $t .= $content . '</' . $tag . '>';
            }
        $t . PHP_EOL;
        return $t;
    }
    

    # funzione di controllo per l'overbooking delle prenotazioni 
    function overbooking ($nome_campo, $data, $orario, $id_prenotazione = ''){

        $database_prenotazioni = lista();
        
        // Se il database è vuoto, la prenotazione è sempre possibile
        if (empty($database_prenotazioni)) {
            return true;
        }

        foreach ($database_prenotazioni as $k => $value) {
            
            // Salto il controllo se stiamo modificando la stessa prenotazione
            if ($k == $id_prenotazione) {
                echo "Prenotazione identica ad una precedentemente registrata!";
                continue;
            }
            
            // Controlla se esiste già una prenotazione con gli stessi parametri
            if ($value['nome_campo'] == $nome_campo 
                && $value['data'] == $data
                && $value['orario'] == $orario) {
                
                echo "Campo NON disponibile nella data e nella fascia oraria selezionata!";
                return false;
            }
        }
        
        // Se arriviamo qui, significa che non ci sono conflitti
        echo "Prenotazione confermata!";
        return true;
    }