<?php

     function creaCampi ($placeholder, $array_campi, $output) {

        $campi = '';      

        foreach ($array_campi as $key => $value) {
            $campi .= '<label>' . $value . '</label><br><input type="text" name="' . $key . '"><br><br>';
        }

        return str_replace($placeholder, $campi, $output);

    }