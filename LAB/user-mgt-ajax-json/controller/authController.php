<?php
    session_start();
    require_once('../model/userModel.php');
    require_once('common.php');

    $action = isset($_GET['action']) ? $_GET['action'] : '';

    if($action == 'login'){
        $data = getJsonInput();

        $username = isset($data['username']) ? trim($data['username']) : '';
        $password = isset($data['password']) ? trim($data['password']) : '';

        if($username == '' || $password == ''){
            sendJson([
                'success' => false,
                'message' => 'Username and password are required.'
            ]);
        }

        $user = [
            'username' => $username,
            'password' => $password
        ];

        $loggedUser = login($user);

        if($loggedUser != false){
            $_SESSION['status'] = true;
            $_SESSION['user_id'] = $loggedUser['id'];
            $_SESSION['username'] = $loggedUser['username'];

            setcookie('status', 'true', time() + 3600, '/');

            sendJson([
                'success' => true,
                'message' => 'Login successful.',
                'redirect' => 'home.php'
            ]);
        }

        sendJson([
            'success' => false,
            'message' => 'Invalid username or password.'
        ]);
    }

    if($action == 'signup'){
        $data = getJsonInput();

        $username = isset($data['username']) ? trim($data['username']) : '';
        $password = isset($data['password']) ? trim($data['password']) : '';
        $email = isset($data['email']) ? trim($data['email']) : '';

        if($username == '' || $password == '' || $email == ''){
            sendJson([
                'success' => false,
                'message' => 'Username, password and email are required.'
            ]);
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            sendJson([
                'success' => false,
                'message' => 'Please enter a valid email address.'
            ]);
        }

        $user = [
            'username' => $username,
            'password' => $password,
            'email' => $email
        ];

        $status = addUser($user);

        if($status === 'duplicate'){
            sendJson([
                'success' => false,
                'message' => 'Username already exists.'
            ]);
        }

        if($status){
            sendJson([
                'success' => true,
                'message' => 'Signup successful. Please login now.',
                'redirect' => 'login.php'
            ]);
        }

        sendJson([
            'success' => false,
            'message' => 'Signup failed. Please try again.'
        ]);
    }

    if($action == 'logout'){
        session_destroy();
        setcookie('status', '', time() - 3600, '/');
        header('location: ../view/login.php');
        exit;
    }

    sendJson([
        'success' => false,
        'message' => 'Invalid auth action.'
    ]);
?>
