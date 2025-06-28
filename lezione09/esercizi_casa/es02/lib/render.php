<?php

    /*
     * libreria di funzioni per il rendering dei template
     */

    namespace Render;

    function render($tpl, $dati) {
        $contenuto = file_get_contents($tpl);
        foreach ($dati as $k => $v) 
            {
                $contenuto = str_replace($k, $v, $contenuto);
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

    $value_input = array (

        '{{val_id}}' => '',
        '{{val_nome}}' => '',
        '{{val_telefono}}' => '',
        '{{val_camera}}' => '',
        '{{val_arrivo}}' => '',
        '{{val_partenza}}' => '',
    );