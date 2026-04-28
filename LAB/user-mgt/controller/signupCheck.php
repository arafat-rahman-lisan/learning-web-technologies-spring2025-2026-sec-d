<?php
session_start();

if (isset($_POST['submit'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email    = trim($_POST['email']);

    if ($username == "" || $password == "" || $email == "") {
        echo "null username/password/email!";
        exit;
    }

    // Create users list if it does not already exist
    if (!isset($_SESSION['users'])) {
        $_SESSION['users'] = [
            ['id'=>1, 'username'=>'abc', 'password'=>'123', 'email'=>'abc@aiub.edu'],
            ['id'=>2, 'username'=>'xyz', 'password'=>'123', 'email'=>'xyz@aiub.edu'],
            ['id'=>3, 'username'=>'alamin', 'password'=>'123', 'email'=>'alamin@aiub.edu'],
            ['id'=>4, 'username'=>'test', 'password'=>'123', 'email'=>'test@aiub.edu'],
            ['id'=>5, 'username'=>'pqr', 'password'=>'123', 'email'=>'pqr@aiub.edu']
        ];
    }

    // Generate new ID
    $lastId = 0;
    foreach ($_SESSION['users'] as $user) {
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

    // Add new user to user list
    $_SESSION['users'][] = $newUser;

    // Also save current registered user
    $_SESSION['user'] = $newUser;

    header('location: ../view/login.php');
    exit;

} else {
    echo "invalid request! please submit form...";
}
?>