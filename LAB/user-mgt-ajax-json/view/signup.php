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
    <title>Signup</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>
<body>
    <div class="box">
        <h1>Signup</h1>

        <p id="message" class="message"></p>

        <form id="signupForm">
            <label>Username</label>
            <input type="text" id="username" name="username">

            <label>Password</label>
            <input type="password" id="password" name="password">

            <label>Email</label>
            <input type="email" id="email" name="email">

            <button type="submit">Signup</button>
            <a href="login.php">Login</a>
        </form>
    </div>

    <script src="../ajax/auth.js"></script>
</body>
</html>
