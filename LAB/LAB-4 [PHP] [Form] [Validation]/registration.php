<?php
$name = $email = $username = $password = $confirmPassword = $gender = "";
$day = $month = $year = "";

$nameErr = $emailErr = $usernameErr = $passwordErr = $confirmPasswordErr = $genderErr = $dobErr = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Name
    if (empty(trim($_POST["name"]))) {
        $nameErr = "Name is required";
    } else {
        $name = trim($_POST["name"]);
        if (!preg_match("/^[a-zA-Z.\-\s]+$/", $name)) {
            $nameErr = "Only letters, dot, dash allowed";
        } elseif (str_word_count($name) < 2) {
            $nameErr = "Name must contain at least 2 words";
        }
    }

    // Email
    if (empty(trim($_POST["email"]))) {
        $emailErr = "Email is required";
    } else {
        $email = trim($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Username
    if (empty(trim($_POST["username"]))) {
        $usernameErr = "User Name is required";
    } else {
        $username = trim($_POST["username"]);
        if (strlen($username) < 2) {
            $usernameErr = "User Name must be at least 2 characters";
        } elseif (!preg_match("/^[a-zA-Z0-9._-]+$/", $username)) {
            $usernameErr = "Only letters, numbers, dot, dash, underscore allowed";
        }
    }

    // Password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = $_POST["password"];
        if (strlen($password) < 8) {
            $passwordErr = "Password must be at least 8 characters";
        } elseif (
            !preg_match("/[A-Z]/", $password) ||
            !preg_match("/[a-z]/", $password) ||
            !preg_match("/[0-9]/", $password) ||
            !preg_match("/[@#$%]/", $password)
        ) {
            $passwordErr = "Must contain upper, lower, number and special (@,#,$,%)";
        }
    }

    // Confirm Password
    if (empty($_POST["confirmPassword"])) {
        $confirmPasswordErr = "Confirm Password is required";
    } else {
        $confirmPassword = $_POST["confirmPassword"];
        if ($password !== $confirmPassword) {
            $confirmPasswordErr = "Passwords do not match";
        }
    }

    // Gender
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = $_POST["gender"];
    }

    // Date of Birth
    if (
        empty($_POST["day"]) ||
        empty($_POST["month"]) ||
        empty($_POST["year"])
    ) {
        $dobErr = "Date of Birth is required";
    } else {
        $day = trim($_POST["day"]);
        $month = trim($_POST["month"]);
        $year = trim($_POST["year"]);

        if (!is_numeric($day) || !is_numeric($month) || !is_numeric($year)) {
            $dobErr = "Date of Birth must be numeric";
        } elseif (!checkdate((int)$month, (int)$day, (int)$year)) {
            $dobErr = "Invalid Date of Birth";
        }
    }

    // Success
    if (
        empty($nameErr) &&
        empty($emailErr) &&
        empty($usernameErr) &&
        empty($passwordErr) &&
        empty($confirmPasswordErr) &&
        empty($genderErr) &&
        empty($dobErr)
    ) {
        $success = "Registration successful!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            background: #f2f2f2;
        }

        .container {
            width: 420px;
            margin: 20px auto;
            border: 1px solid #777;
            background: #f7f7f7;
            padding: 14px;
        }

        .title {
            font-weight: bold;
            font-size: 28px;
            margin-bottom: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 7px 0;
            vertical-align: top;
        }

        .label {
            width: 120px;
        }

        .colon {
            width: 15px;
            text-align: center;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 140px;
            padding: 3px;
        }

        fieldset {
            margin-top: 10px;
            margin-bottom: 10px;
            padding: 10px;
        }

        .dob-box input {
            width: 40px;
            margin-right: 4px;
        }

        .buttons {
            margin-top: 10px;
        }

        .buttons input {
            padding: 3px 8px;
            margin-right: 6px;
        }

        .error {
            color: red;
            font-size: 13px;
            display: block;
            margin-top: 2px;
        }

        .success {
            color: green;
            font-weight: bold;
            margin-top: 10px;
        }

        hr {
            border: none;
            border-top: 1px solid #aaa;
            margin: 6px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="title">REGISTRATION</div>

    <form method="post" action="">
        <table>
            <tr>
                <td class="label">Name</td>
                <td class="colon">:</td>
                <td>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
                    <span class="error"><?php echo $nameErr; ?></span>
                </td>
            </tr>
        </table>
        <hr>

        <table>
            <tr>
                <td class="label">Email</td>
                <td class="colon">:</td>
                <td>
                    <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
                    <span class="error"><?php echo $emailErr; ?></span>
                </td>
            </tr>
        </table>
        <hr>

        <table>
            <tr>
                <td class="label">User Name</td>
                <td class="colon">:</td>
                <td>
                    <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
                    <span class="error"><?php echo $usernameErr; ?></span>
                </td>
            </tr>
        </table>
        <hr>

        <table>
            <tr>
                <td class="label">Password</td>
                <td class="colon">:</td>
                <td>
                    <input type="password" name="password">
                    <span class="error"><?php echo $passwordErr; ?></span>
                </td>
            </tr>
        </table>
        <hr>

        <table>
            <tr>
                <td class="label">Confirm Password</td>
                <td class="colon">:</td>
                <td>
                    <input type="password" name="confirmPassword">
                    <span class="error"><?php echo $confirmPasswordErr; ?></span>
                </td>
            </tr>
        </table>
        <hr>

        <fieldset>
            <legend>Gender</legend>
            <input type="radio" name="gender" value="Male" <?php if ($gender == "Male") echo "checked"; ?>>Male
            <input type="radio" name="gender" value="Female" <?php if ($gender == "Female") echo "checked"; ?>>Female
            <input type="radio" name="gender" value="Other" <?php if ($gender == "Other") echo "checked"; ?>>Other
            <br>
            <span class="error"><?php echo $genderErr; ?></span>
        </fieldset>

        <fieldset>
            <legend>Date of Birth</legend>
            <div class="dob-box">
                <input type="text" name="day" maxlength="2" value="<?php echo htmlspecialchars($day); ?>">
                <input type="text" name="month" maxlength="2" value="<?php echo htmlspecialchars($month); ?>">
                <input type="text" name="year" maxlength="4" value="<?php echo htmlspecialchars($year); ?>">
                <span>(dd/mm/yyyy)</span>
            </div>
            <span class="error"><?php echo $dobErr; ?></span>
        </fieldset>

        <hr>

        <div class="buttons">
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
        </div>

        <?php if ($success != "") { ?>
            <div class="success"><?php echo $success; ?></div>
        <?php } ?>
    </form>
</div>

</body>
</html>