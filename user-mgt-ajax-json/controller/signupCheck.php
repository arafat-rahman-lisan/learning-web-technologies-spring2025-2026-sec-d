<?php
    require_once 'helpers.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        json_response([
            'success' => false,
            'message' => 'Invalid request method.'
        ], 405);
    }

    $newUserData = get_json_user_from_post();

    $username = trim($newUserData['username'] ?? '');
    $password = trim($newUserData['password'] ?? '');
    $email    = trim($newUserData['email'] ?? '');

    if ($username === '' || $password === '' || $email === '') {
        json_response([
            'success' => false,
            'message' => 'Username, password and email are required.'
        ]);
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        json_response([
            'success' => false,
            'message' => 'Please enter a valid email address.'
        ]);
    }

    $users = read_users();

    foreach ($users as $user) {
        if ($user['username'] === $username) {
            json_response([
                'success' => false,
                'message' => 'Username already exists.'
            ]);
        }

        if ($user['email'] === $email) {
            json_response([
                'success' => false,
                'message' => 'Email already exists.'
            ]);
        }
    }

    $lastId = 0;
    foreach ($users as $user) {
        if ($user['id'] > $lastId) {
            $lastId = $user['id'];
        }
    }

    $newUser = [
        'id' => $lastId + 1,
        'username' => $username,
        'password' => $password,
        'email' => $email
    ];

    $users[] = $newUser;
    save_users($users);

    json_response([
        'success' => true,
        'message' => 'Signup successful. Please login now.',
        'redirect' => '../view/login.php'
    ]);
?>
