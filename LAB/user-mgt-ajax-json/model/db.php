<?php
    // Database connection file
    // Import database/webtech.sql first, then run the project.

    $host = "127.0.0.1";
    $dbuser = "root";
    $dbpassword = "";
    $dbname = "webtech";

    function getConnection(){
        global $host;
        global $dbuser;
        global $dbpassword;
        global $dbname;

        $con = mysqli_connect($host, $dbuser, $dbpassword, $dbname);

        if(!$con){
            die("Database connection failed: " . mysqli_connect_error());
        }

        return $con;
    }
?>
