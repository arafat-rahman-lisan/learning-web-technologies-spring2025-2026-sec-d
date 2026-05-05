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

        <p id="msg" class="message"></p>

        <form id="signupForm">
            <label>Username</label>
            <input type="text" id="username" name="username">

            <label>Password</label>
            <input type="password" id="password" name="password">

            <label>Email</label>
            <input type="email" id="email" name="email">

            <button type="submit">Signup</button>
        </form>

        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>

    <script src="../ajax/signup.js"></script>
</body>
</html>
