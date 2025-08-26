<?php

    $pdo = new PDO(
        'mysql:host=localhost; dbname=estate_es12_officina; charset=utf8', 
        'userphp', 
        'admin');
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, 
        PDO::ERRMODE_EXCEPTION);