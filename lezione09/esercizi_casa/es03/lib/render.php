<?php

    /*
     * libreria di funzioni per il rendering dei template
     */

    namespace Render;

    function render($tpl, $dati) {
        $contenuto = $tpl;
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
