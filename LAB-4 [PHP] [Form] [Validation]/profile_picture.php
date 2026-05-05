<?php
$message = "";
$messageColor = "red";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if file selected
    if (!isset($_FILES["profilePic"]) || $_FILES["profilePic"]["error"] == 4) {
        $message = "Please choose a profile picture.";
    } else {
        $file = $_FILES["profilePic"];

        $fileName = $file["name"];
        $fileTmp  = $file["tmp_name"];
        $fileSize = $file["size"];
        $fileError = $file["error"];

        $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Check upload error
        if ($fileError !== 0) {
            $message = "File upload error occurred.";
        }
        // Check extension
        elseif (!in_array($fileExt, $allowedExtensions)) {
            $message = "Only JPG, JPEG, PNG, and GIF files are allowed.";
        }
        // Check image type
        elseif (getimagesize($fileTmp) === false) {
            $message = "Selected file is not a valid image.";
        }
        // Check size (2 MB)
        elseif ($fileSize > 2 * 1024 * 1024) {
            $message = "File size must be less than 2 MB.";
        }
        else {
            // Create uploads folder if not exists
            if (!is_dir("uploads")) {
                mkdir("uploads", 0777, true);
            }

            $newFileName = time() . "_" . preg_replace("/[^a-zA-Z0-9.\-_]/", "", $fileName);
            $destination = "uploads/" . $newFileName;

            if (move_uploaded_file($fileTmp, $destination)) {
                $message = "Profile picture uploaded successfully.";
                $messageColor = "green";
            } else {
                $message = "Failed to upload file.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile Picture Upload</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #efefef;
        }

        .box {
            width: 210px;
            margin: 20px auto;
            border: 1px solid #888;
            padding: 10px;
            background: #f5f5f5;
        }

        .title {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .profile-img {
            display: block;
            width: 120px;
            height: 120px;
            object-fit: contain;
            margin: 0 auto 10px auto;
        }

        input[type="file"] {
            margin-bottom: 12px;
            width: 100%;
        }

        hr {
            border: none;
            border-top: 1px solid #aaa;
            margin: 10px 0;
        }

        input[type="submit"] {
            padding: 4px 10px;
            cursor: pointer;
        }

        .msg {
            margin-top: 10px;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="box">
        <div class="title">PROFILE PICTURE</div>

        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Profile Icon" class="profile-img">

        <form method="post" enctype="multipart/form-data">
            <input type="file" name="profilePic">
            <hr>
            <input type="submit" value="Submit">
        </form>

        <?php if (!empty($message)) { ?>
            <div class="msg" style="color: <?php echo $messageColor; ?>;">
                <?php echo $message; ?>
            </div>
        <?php } ?>
    </div>

</body>
</html>