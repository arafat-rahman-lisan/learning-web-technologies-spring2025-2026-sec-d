<?php
    require_once 'helpers.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        json_response([
            'success' => false,
            'message' => 'Invalid request method.'
        ], 405);
    }

    $loginUser = get_json_user_from_post();

    $username = trim($loginUser['username'] ?? '');
    $password = trim($loginUser['password'] ?? '');

    if ($username === '' || $password === '') {
        json_response([
            'success' => false,
            'message' => 'Username and password are required.'
        ]);
    }

    $users = read_users();

    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            $_SESSION['status'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['current_user_id'] = $user['id'];

            setcookie('status', 'true', time() + 3000, '/');

            json_response([
                'success' => true,
                'message' => 'Login successful.',
                'redirect' => '../view/home.php'
            ]);
        }
    }

    json_response([
        'success' => false,
        'message' => 'Invalid username or password.'
    ]);
?>
