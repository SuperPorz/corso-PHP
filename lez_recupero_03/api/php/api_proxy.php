<?php
// api/php/api_proxy.php

class ApiProxy {
    
    public static function calcolaProvvigioni() {
        $python_api_url = "http://127.0.0.1:5000/api/provvigioni";
        
        // Inizializza cURL
        $ch = curl_init();
        
        curl_setopt_array($ch, [
            CURLOPT_URL => $python_api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
            ]
        ]);
        
        // Esegui la chiamata
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($http_code === 200) {
            return json_decode($response, true);
        } else {
            return [
                'success' => false,
                'error' => 'Errore nella chiamata API Python'
            ];
        }
    }

    public static function vendite_registrate() {
        $python_api_url = "http://127.0.0.1:5000/api/vendite";
        
        // Inizializza cURL
        $ch = curl_init();
        
        curl_setopt_array($ch, [
            CURLOPT_URL => $python_api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
            ]
        ]);
        
        // Esegui la chiamata
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($http_code === 200) {
            return json_decode($response, true);
        } else {
            return [
                'success' => false,
                'error' => 'Errore nella chiamata API Python'
            ];
        }
    }
}