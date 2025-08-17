<?php

    function crea_lista_ul($array_maratona, $stringa) {
        foreach($array_maratona as $film) {
            $stringa .= '<ul><li>' . $film['titolo'] . '</li><ul>';
            
            // Calcola l'orario di fine
            $orario_inizio = $film['orario'];
            $durata = $film['durata'];
            
            // Converti orario in minuti
            $parti_orario = explode(':', $orario_inizio);
            $minuti_inizio = ($parti_orario[0] * 60) + $parti_orario[1];
            $minuti_fine = $minuti_inizio + $durata;
            
            // Converti i minuti finali in formato HH:MM
            $ore_fine = intval($minuti_fine / 60);
            $min_fine = $minuti_fine % 60;
            $orario_fine = sprintf('%02d:%02d', $ore_fine, $min_fine);
            
            foreach($film as $k => $v) {
                if ($k == 'titolo') {
                    continue;
                }
                if ($k == 'orario') {
                    $stringa .= '<li>orario inizio: ' . $v . '</li>';
                    $stringa .= '<li>orario fine: ' . $orario_fine . '</li>';
                } else if ($k == 'durata') {
                    $stringa .= '<li>' . $k . ': ' . $v . ' min</li>';
                } else {
                    $stringa .= '<li>' . $k . ': ' . $v . '</li>';
                }
            }
            $stringa .= '</ul></ul>';
        }
        return $stringa;
    }

    function calcola_orari_maratona($maratona_mattina, $maratona_pomeriggio, $maratona_sera) {
    
        // CALCOLO ORARI MATTINA (11:00 - 13:00)
        $orario_corrente = 11 * 60; // 11:00 in minuti
        foreach ($maratona_mattina as &$film) {
            $ore = intval($orario_corrente / 60);
            $minuti = $orario_corrente % 60;
            $film['orario'] = sprintf('%02d:%02d', $ore, $minuti);
            $orario_corrente += $film['durata'];
        }
        
        // CALCOLO ORARI POMERIGGIO (14:00 - 20:00)
        $orario_corrente = 14 * 60; // 14:00 in minuti
        foreach ($maratona_pomeriggio as &$film) {
            $ore = intval($orario_corrente / 60);
            $minuti = $orario_corrente % 60;
            $film['orario'] = sprintf('%02d:%02d', $ore, $minuti);
            $orario_corrente += $film['durata'];
        }
        
        // CALCOLO ORARI SERA (21:00 - 24:00)
        $orario_corrente = 21 * 60; // 21:00 in minuti
        foreach ($maratona_sera as &$film) {
            $ore = intval($orario_corrente / 60);
            $minuti = $orario_corrente % 60;
            $film['orario'] = sprintf('%02d:%02d', $ore, $minuti);
            $orario_corrente += $film['durata'];
        }
        
        return [$maratona_mattina, $maratona_pomeriggio, $maratona_sera];
    }