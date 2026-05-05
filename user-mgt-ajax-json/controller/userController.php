<?php
    require_once 'helpers.php';
    require_login_json();

    $action = $_GET['action'] ?? $_POST['action'] ?? '';
    $users = read_users();

    if ($action === 'list') {
        $safeUsers = [];

        foreach ($users as $user) {
            $safeUsers[] = remove_password($user);
        }

        json_response([
            'success' => true,
            'users' => $safeUsers
        ]);
    }

    if ($action === 'get') {
        $id = intval($_GET['id'] ?? 0);

        foreach ($users as $user) {
            if (intval($user['id']) === $id) {
                json_response([
                    'success' => true,
                    'user' => remove_password($user)
                ]);
            }
        }

        json_response([
            'success' => false,
            'message' => 'User not found.'
        ], 404);
    }

    if ($action === 'update') {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_response([
                'success' => false,
                'message' => 'Invalid request method.'
            ], 405);
        }

        $updatedUser = get_json_user_from_post();

        $id = intval($updatedUser['id'] ?? 0);
        $username = trim($updatedUser['username'] ?? '');
        $email = trim($updatedUser['email'] ?? '');

        if ($id <= 0 || $username === '' || $email === '') {
            json_response([
                'success' => false,
                'message' => 'ID, username and email are required.'
            ]);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            json_response([
                'success' => false,
                'message' => 'Please enter a valid email address.'
            ]);
        }

        foreach ($users as $user) {
            if (intval($user['id']) !== $id && $user['username'] === $username) {
                json_response([
                    'success' => false,
                    'message' => 'Another user already has this username.'
                ]);
            }

            if (intval($user['id']) !== $id && $user['email'] === $email) {
                json_response([
                    'success' => false,
                    'message' => 'Another user already has this email.'
                ]);
            }
        }

        $found = false;

        foreach ($users as $key => $user) {
            if (intval($user['id']) === $id) {
                $users[$key]['username'] = $username;
                $users[$key]['email'] = $email;
                $found = true;
                break;
            }
        }

        if (!$found) {
            json_response([
                'success' => false,
                'message' => 'User not found.'
            ], 404);
        }

        save_users($users);

        json_response([
            'success' => true,
            'message' => 'User updated successfully.'
        ]);
    }

    if ($action === 'delete') {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_response([
                'success' => false,
                'message' => 'Invalid request method.'
            ], 405);
        }

        $id = intval($_POST['id'] ?? 0);

        if ($id <= 0) {
            json_response([
                'success' => false,
                'message' => 'Invalid user ID.'
            ]);
        }

        if (isset($_SESSION['current_user_id']) && intval($_SESSION['current_user_id']) === $id) {
            json_response([
                'success' => false,
                'message' => 'You cannot delete the currently logged-in user.'
            ]);
        }

        $found = false;

        foreach ($users as $key => $user) {
            if (intval($user['id']) === $id) {
                unset($users[$key]);
                $found = true;
                break;
            }
        }

        if (!$found) {
            json_response([
                'success' => false,
                'message' => 'User not found.'
            ], 404);
        }

        $users = array_values($users);
        save_users($users);

        json_response([
            'success' => true,
            'message' => 'User deleted successfully.'
        ]);
    }

    json_response([
        'success' => false,
        'message' => 'Invalid action.'
    ], 400);
?>
