<?php

    $pdo = new PDO('mysql:host=localhost; dbname=libro_03;
        charset=utf8', 'userphp', 'admin');
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, 
        PDO::ERRMODE_EXCEPTION);