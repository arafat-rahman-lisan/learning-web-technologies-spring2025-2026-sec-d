<?php
    session_start();

    if (!isset($_COOKIE['status'])) {
        header('location: login.php');
        exit;
    }

    if (!isset($_GET['id'])) {
        echo "No user ID found!";
        exit;
    }

    if (!isset($_SESSION['users'])) {
        echo "No users found!";
        exit;
    }

    $id = $_GET['id'];
    $selectedUser = null;

    foreach ($_SESSION['users'] as $user) {
        if ($user['id'] == $id) {
            $selectedUser = $user;
            break;
        }
    }

    if ($selectedUser == null) {
        echo "User not found!";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Details</title>
</head>
<body>
    <h1>User Details</h1>

    <a href="user_list.php">Back</a> |
    <a href="../controller/logout.php">logout</a>
    <br><br>

    <table border="1">
        <tr>
            <th>ID</th>
            <td><?php echo $selectedUser['id']; ?></td>
        </tr>
        <tr>
            <th>Username</th>
            <td><?php echo $selectedUser['username']; ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo $selectedUser['email']; ?></td>
        </tr>
    </table>

    <br>
    <a href="edit.php?id=<?php echo $selectedUser['id']; ?>">Edit This User</a>
</body>
</html>