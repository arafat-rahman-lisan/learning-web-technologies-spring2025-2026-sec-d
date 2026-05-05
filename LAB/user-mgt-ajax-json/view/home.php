<?php
    session_start();
    if (!isset($_SESSION['status']) || $_SESSION['status'] !== true) {
        header('location: login.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>
<body>
    <div class="box">
        <h1>Welcome Home, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>

        <p>This page is protected. Only logged-in users can see it.</p>

        <a class="btn-link" href="user_list.php">User Management</a>
        <a class="btn-link danger" href="../controller/logout.php">Logout</a>
    </div>
</body>
</html>
