<?php
session_start();

if (isset($_POST['submit'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username == "" || $password == "") {
        echo "null username/password!";
        exit;
    }

    if (!isset($_SESSION['users'])) {
        echo "No registered users found!";
        exit;
    }

    $found = false;

    foreach ($_SESSION['users'] as $user) {
        if ($user['username'] == $username && $user['password'] == $password) {
            $found = true;
            $_SESSION['username'] = $username;
            $_SESSION['current_user'] = $user;

            setcookie('status', true, time() + 3000, '/');
            header('location: ../view/home.php');
            exit;
        }
    }

    if (!$found) {
        echo "invalid user!";
    }

} else {
    echo "invalid request! please submit form...";
}
?>