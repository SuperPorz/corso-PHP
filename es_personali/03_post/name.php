<?php

    $first_name = htmlspecialchars($_POST['first_name'], ENT_QUOTES, 'UTF-8');
    $last_name = htmlspecialchars($_POST['last_name'], ENT_QUOTES, 'UTF-8');

    echo 'Welcome to our website, ' . $first_name . ' ' . $last_name . '!';
    echo '<p><a href="name.html">HOMEPAGE</a></p>'
?>