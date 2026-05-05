<?php
    session_start();
    if(!isset($_SESSION['status']) || $_SESSION['status'] !== true){
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
        <h1>Welcome Home! <?php echo $_SESSION['username']; ?></h1>
        <a href="user_list.php">User List</a> |
        <a href="../controller/authController.php?action=logout">Logout</a>
    </div>
</body>
</html>
