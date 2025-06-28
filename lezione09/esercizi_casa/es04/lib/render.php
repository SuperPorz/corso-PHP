<?php

    /*
     * libreria di funzioni per il rendering dei template
     */

    namespace Render;

    function render($tpl, $dati) {
        $contenuto = file_get_contents($tpl);
        foreach ($dati as $k => $v) 
            {
                $contenuto = str_replace('{{' . $k . '}}', $v, $contenuto);
            }
        return $contenuto;
    }

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

    function build_tab ($array_database, $nome_pagina) {

        # logica di creazione tabella
        $righe_tabella_piloti = []; 
        foreach ($array_database as $k => $value) 
            {
                $campi = []; 
                $campi[] = tag('td', [], $k);
                foreach ($value as $k2 => $v2) {
                    $campi[] = tag('td', [], $v2);
                }

                if (!empty($nome_pagina)) {
                    #aggiungo i tasti 'modifica' ed 'elimina' se la variabile non è vuota (non mi servono i tasti modifica/elimina nella pagina classifiche)
                    $campi[] = tag('td', [], tag('a', ['href' => $nome_pagina . '.html?edit_id=' .$k], 'Modifica'));
                    $campi[] = tag('td', [], tag('a', ['href' => $nome_pagina . '.html?delete_id=' .$k], 'Elimina'));
                }

                $righe_tabella_piloti[] = tag('tr', [], implode($campi));
            }

        # logica condizionale se l'array in input è vuoto o no  
        if ($righe_tabella_piloti != []) { 
            $table = tag('table', ['border' => 1], implode($righe_tabella_piloti));
            return $table;
        } else { 
            $table = '';
            return $table;
        }
    }