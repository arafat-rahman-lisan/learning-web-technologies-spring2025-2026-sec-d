<?php
    require_once('../model/userModel.php');
    require_once('common.php');

    requireLoginForAjax();

    $action = isset($_GET['action']) ? $_GET['action'] : '';

    if($action == 'list'){
        $users = getAllUser();
        sendJson([
            'success' => true,
            'users' => $users
        ]);
    }

    if($action == 'details'){
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        if($id <= 0){
            sendJson([
                'success' => false,
                'message' => 'Invalid user ID.'
            ]);
        }

        $user = getUserById($id);

        if($user != false){
            sendJson([
                'success' => true,
                'user' => $user
            ]);
        }

        sendJson([
            'success' => false,
            'message' => 'User not found.'
        ]);
    }

    if($action == 'add'){
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

        $status = addUser([
            'username' => $username,
            'password' => $password,
            'email' => $email
        ]);

        if($status === 'duplicate'){
            sendJson([
                'success' => false,
                'message' => 'Username already exists.'
            ]);
        }

        if($status){
            sendJson([
                'success' => true,
                'message' => 'User added successfully.'
            ]);
        }

        sendJson([
            'success' => false,
            'message' => 'Failed to add user.'
        ]);
    }

    if($action == 'update'){
        $data = getJsonInput();

        $id = isset($data['id']) ? intval($data['id']) : 0;
        $username = isset($data['username']) ? trim($data['username']) : '';
        $password = isset($data['password']) ? trim($data['password']) : '';
        $email = isset($data['email']) ? trim($data['email']) : '';

        if($id <= 0 || $username == '' || $email == ''){
            sendJson([
                'success' => false,
                'message' => 'ID, username and email are required.'
            ]);
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            sendJson([
                'success' => false,
                'message' => 'Please enter a valid email address.'
            ]);
        }

        $user = [
            'id' => $id,
            'username' => $username,
            'email' => $email,
            'password' => $password
        ];

        $status = updateUser($user);

        if($status){
            sendJson([
                'success' => true,
                'message' => 'User updated successfully.'
            ]);
        }

        sendJson([
            'success' => false,
            'message' => 'Failed to update user.'
        ]);
    }

    if($action == 'delete'){
        $data = getJsonInput();
        $id = isset($data['id']) ? intval($data['id']) : 0;

        if($id <= 0){
            sendJson([
                'success' => false,
                'message' => 'Invalid user ID.'
            ]);
        }

        $status = deleteUser($id);

        if($status){
            sendJson([
                'success' => true,
                'message' => 'User deleted successfully.'
            ]);
        }

        sendJson([
            'success' => false,
            'message' => 'Failed to delete user.'
        ]);
    }

    sendJson([
        'success' => false,
        'message' => 'Invalid user action.'
    ]);
?>
