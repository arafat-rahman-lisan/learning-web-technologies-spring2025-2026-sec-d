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
    <title>User List</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>
<body>
    <div class="wide-box">
        <h1>All Users</h1>
        <a href="home.php">Back</a> |
        <a href="../controller/authController.php?action=logout">Logout</a>

        <p id="message" class="message"></p>

        <h2 id="formTitle">Add User</h2>
        <form id="userForm">
            <input type="hidden" id="userId">

            <label>Username</label>
            <input type="text" id="username">

            <label>Password</label>
            <input type="password" id="password" placeholder="Required for new user, optional while editing">

            <label>Email</label>
            <input type="email" id="email">

            <button type="submit" id="saveBtn">Add User</button>
            <button type="button" id="cancelBtn">Cancel Edit</button>
        </form>

        <h2>User List Loaded by AJAX</h2>
        <table border="1" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                <tr>
                    <td colspan="4">Loading...</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="../ajax/users.js"></script>
</body>
</html>
