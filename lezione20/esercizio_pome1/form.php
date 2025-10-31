<?php

    session_start();

    $animale = $_POST['animale'];

    $_SESSION['animale'] = $animale;

    header('Location: lettura.php');