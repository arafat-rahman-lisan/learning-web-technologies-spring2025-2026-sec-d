<?php
    session_start();
    if(isset($_SESSION['status']) && $_SESSION['status'] === true){
        header('location: home.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>
<body>
    <div class="box">
        <h1>Login</h1>

        <p id="message" class="message"></p>

        <form id="loginForm">
            <label>Username</label>
            <input type="text" id="username" name="username">

            <label>Password</label>
            <input type="password" id="password" name="password">

            <button type="submit">Login</button>
            <a href="signup.php">Signup</a>
        </form>
    </div>

    <script src="../ajax/auth.js"></script>
</body>
</html>
