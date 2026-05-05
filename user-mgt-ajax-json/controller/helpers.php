<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    define('USERS_FILE', __DIR__ . '/../data/users.json');

    function json_response($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    function read_users() {
        if (!file_exists(USERS_FILE)) {
            return [];
        }

        $json = file_get_contents(USERS_FILE);
        $users = json_decode($json, true);

        if (!is_array($users)) {
            return [];
        }

        return $users;
    }

    function save_users($users) {
        file_put_contents(USERS_FILE, json_encode($users, JSON_PRETTY_PRINT));
    }

    function remove_password($user) {
        unset($user['password']);
        return $user;
    }

    function is_logged_in() {
        return isset($_SESSION['status']) && $_SESSION['status'] === true;
    }

    function require_login_json() {
        if (!is_logged_in()) {
            json_response([
                'success' => false,
                'message' => 'You are not logged in.',
                'redirect' => '../view/login.php'
            ], 401);
        }
    }

    function get_json_user_from_post() {
        if (!isset($_POST['user'])) {
            json_response([
                'success' => false,
                'message' => 'No JSON user data received.'
            ], 400);
        }

        $user = json_decode($_POST['user'], true);

        if (!is_array($user)) {
            json_response([
                'success' => false,
                'message' => 'Invalid JSON format.'
            ], 400);
        }

        return $user;
    }
?>
