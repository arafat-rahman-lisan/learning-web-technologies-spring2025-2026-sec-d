<?php
    session_start();

     //print_r($_SESSION);
    if(!isset($_COOKIE['status'])){
         header('location: login.php');
    }

    if (isset($_POST['submit'])) 
        
    {
        $id = $_POST['id'];
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);


        if ($id == "" || $username == "" || $email == "") {
            echo "ID/Username/Email cannot be empty!";
            exit;
        }

        foreach ($_SESSION['users'] as $key => $user) {
            if ($user['id'] == $id) {
                $_SESSION['users'][$key]['username'] = $username;
                $_SESSION['users'][$key]['email'] = $email;//post email upore , which coms from edit.php
                break;
            }
        }

        header('location: ../view/user_list.php');
        exit;
    } else {
        echo "Invalid request!";
    }
?>