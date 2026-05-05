<?php
    session_start();

    if (isset($_POST['submit'])) {

        if (!isset($_POST['id'])) {
            echo "No user ID found!";
            exit;
        }

        if (!isset($_SESSION['users'])) {
            echo "No users found!";
            exit;
        }

        $id = $_POST['id'];
        $found = false;

        foreach ($_SESSION['users'] as $key => $user) {
            if ($user['id'] == $id) {
                unset($_SESSION['users'][$key]);
                $found = true;
                break;
            }
        }

        if (!$found) {
            echo "User not found!";
            exit;
        }

        $_SESSION['users'] = array_values($_SESSION['users']);

        header('location: ../view/user_list.php');
        exit;

    } else {
        echo "Invalid request!";
    }
?>