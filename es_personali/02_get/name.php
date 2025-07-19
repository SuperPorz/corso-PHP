<?php

    $first_name = htmlspecialchars($_GET['firstname'], ENT_QUOTES, 'UTF-8');
    $last_name = htmlspecialchars($_GET['lastname'], ENT_QUOTES, 'UTF-8');

    echo 'Welcome to our website, ' . $first_name . ' ' . $last_name . '!';
?>