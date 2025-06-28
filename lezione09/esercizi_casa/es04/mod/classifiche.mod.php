<?php

    namespace Classifiche;

    function sorting($lista_unsorted = []) {
        
        // Estraggo tutti i punteggi in un array separato
        $punteggi = [];
        foreach ($lista_unsorted as $id => $sub_array) {
            $punteggi[$id] = (int)$sub_array['punteggio'];
        }
        
        // Ordino i punteggi in ordine decrescente mantenendo le chiavi
        arsort($punteggi);
        
        // Ricostruisco l'array originale nell'ordine corretto
        $lista_ordinata = [];
        foreach ($punteggi as $id => $punteggio) {
            $lista_ordinata[$id] = $lista_unsorted[$id];
        }
        
        return $lista_ordinata;
    }