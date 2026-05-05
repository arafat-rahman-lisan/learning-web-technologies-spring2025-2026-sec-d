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
    <title>User Management</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>
<body>
    <div class="wide-box">
        <h1>User Management</h1>

        <div class="top-nav">
            <a href="home.php">Back Home</a>
            <a href="../controller/logout.php">Logout</a>
        </div>

        <p id="msg" class="message"></p>

        <table>
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
                    <td colspan="4">Loading users...</td>
                </tr>
            </tbody>
        </table>

        <div id="detailsBox" class="panel hidden"></div>

        <div id="editBox" class="panel hidden">
            <h2>Edit User</h2>
            <form id="editForm">
                <label>ID</label>
                <input type="text" id="editId" readonly>

                <label>Username</label>
                <input type="text" id="editUsername">

                <label>Email</label>
                <input type="email" id="editEmail">

                <button type="submit">Update</button>
                <button type="button" onclick="hideEditBox()">Cancel</button>
            </form>
        </div>
    </div>

    <script src="../ajax/users.js"></script>
</body>
</html>
