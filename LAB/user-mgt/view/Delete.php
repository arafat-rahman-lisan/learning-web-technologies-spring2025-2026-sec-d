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
    <title>Delete User</title>
</head>
<body>
    <h1>Delete User</h1>


    <a href="user_list.php">Back</a> |
    <a href="../controller/logout.php">logout</a>
    <br><br>

    <p>Are you sure you want to delete this user?</p>

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

    <form method="post" action="../controller/deleteCheck.php">
        <input type="hidden" name="id" value="<?php echo $selectedUser['id']; ?>">
        <input type="submit" name="submit" value="Delete">
        <a href="user_list.php">Cancel</a>
    </form>
</body>
</html>