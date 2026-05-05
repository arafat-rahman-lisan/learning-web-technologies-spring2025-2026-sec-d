<?php
    require_once 'helpers.php';

    session_unset();
    session_destroy();

    setcookie('status', '', time() - 10, '/');

    header('location: ../view/login.php');
    exit;
?>
