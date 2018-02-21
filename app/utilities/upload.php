<?php
session_start();

$username = $_SESSION['username'];
$uploaddir = "../uploads/";
$filename = $username . '-' . basename($_FILES["fileToUpload"]["name"]);
$uploadfile = $uploaddir . $filename;
$dbfilename = "./uploads/" . $filename ;
$isSuccess = 0;
if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadfile)) {
    $isSuccess = 1;
} else {
    $isSuccess = 0;
    header("location: ../profile.php");
    exit;
}

// Include config file
require_once 'config.php';

// Validate credentials
if (!empty($uploadfile)) {
    // Prepare a select statement
    $sql = "UPDATE User SET profile = ? where username = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ss", $param_uploadfile, $param_username);

        // Set parameters
        $param_username = $username;
        $param_uploadfile = $dbfilename;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Close statement
            mysqli_stmt_close($stmt);
            mysqli_close($link);
            // Redirect to profile page
            $_SESSION['profile'] = $param_uploadfile;
            header("location: ../profile.php");
            exit;
        } else {
            // Close statement
            mysqli_stmt_close($stmt);
            mysqli_close($link);
            echo "Something went wrong. Please try again later.";
        }
    }
}


?>
