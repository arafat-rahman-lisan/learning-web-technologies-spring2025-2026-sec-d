<?php
    require_once('db.php');

    function login($user){
        $con = getConnection();

        $sql = "select * from users where username = ? and password = ? limit 1";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $user['username'], $user['password']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);
            mysqli_close($con);
            return $row;
        }

        mysqli_stmt_close($stmt);
        mysqli_close($con);
        return false;
    }

    function addUser($user){
        $con = getConnection();

        $checkSql = "select id from users where username = ? limit 1";
        $checkStmt = mysqli_prepare($con, $checkSql);
        mysqli_stmt_bind_param($checkStmt, "s", $user['username']);
        mysqli_stmt_execute($checkStmt);
        $checkResult = mysqli_stmt_get_result($checkStmt);

        if(mysqli_num_rows($checkResult) > 0){
            mysqli_stmt_close($checkStmt);
            mysqli_close($con);
            return "duplicate";
        }
        mysqli_stmt_close($checkStmt);

        $sql = "insert into users (username, password, email) values (?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $user['username'], $user['password'], $user['email']);
        $status = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        mysqli_close($con);

        return $status;
    }

    function deleteUser($id){
        $con = getConnection();

        $sql = "delete from users where id = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        $status = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        mysqli_close($con);

        return $status;
    }

    function updateUser($user){
        $con = getConnection();

        if(isset($user['password']) && trim($user['password']) != ""){
            $sql = "update users set username = ?, password = ?, email = ? where id = ?";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "sssi", $user['username'], $user['password'], $user['email'], $user['id']);
        }else{
            $sql = "update users set username = ?, email = ? where id = ?";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "ssi", $user['username'], $user['email'], $user['id']);
        }

        $status = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        mysqli_close($con);

        return $status;
    }

    function getAllUser(){
        $con = getConnection();

        $sql = "select id, username, email from users order by id asc";
        $result = mysqli_query($con, $sql);

        $users = [];
        while($row = mysqli_fetch_assoc($result)){
            $users[] = $row;
        }

        mysqli_close($con);
        return $users;
    }

    function getUserById($id){
        $con = getConnection();

        $sql = "select id, username, email from users where id = ? limit 1";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);
            mysqli_close($con);
            return $row;
        }

        mysqli_stmt_close($stmt);
        mysqli_close($con);
        return false;
    }
?>
