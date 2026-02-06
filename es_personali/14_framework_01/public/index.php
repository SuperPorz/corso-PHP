<?php
    try {
        include __DIR__ . '/../classes/EntryPoint.php';
        
        // Con FallbackResource, la route arriva in REDIRECT_URL
        $requestUri = isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : $_SERVER['REQUEST_URI'];
        
        // Rimuovi il base path
        $basePath = '/corso-PHP/es_personali/14_framework_01/public';
        if (strpos($requestUri, $basePath) === 0) {
            $requestUri = substr($requestUri, strlen($basePath));
        }
        
        // Rimuovi index.php se presente
        $requestUri = str_replace('/index.php', '', $requestUri);
        
        // Pulisci la route
        $route = trim(strtok($requestUri, '?'), '/');
        
        $entryPoint = new EntryPoint($route);
        define('BASE_URL', $entryPoint->getBaseUrl());
        $entryPoint->run();
    } 
    catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage() . ' in '
        . $e->getFile() . ':' . $e->getLine();
        include __DIR__ . '/../templates/layout.html.php';
    }
    catch (Exception $e) {
        $title = 'An error has occurred';
        $output = 'Application error: ' . $e->getMessage();
        include __DIR__ . '/../templates/layout.html.php';
    }