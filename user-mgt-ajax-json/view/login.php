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

        <p id="msg" class="message"></p>

        <form id="loginForm">
            <label>Username</label>
            <input type="text" id="username" name="username">

            <label>Password</label>
            <input type="password" id="password" name="password">

            <button type="submit">Login</button>
        </form>

        <p>Do not have an account? <a href="signup.php">Signup</a></p>
        <p class="hint">Demo user: abc | Password: 123</p>
    </div>

    <script src="../ajax/login.js"></script>
</body>
</html>
