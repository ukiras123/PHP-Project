<?php

require_once 'utilities/generic-function.php';

$title = "My Profile";
$reserve_rent = "";
$name = "";
$content = "";
$reserveActive = "";
$reportActive = "";
$profileActive = "active";
$indexActive = "";
$profile = "";
session_start();
// If session variable is not set it will redirect to login page
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("location: userlogin/login.php");
    exit;
} else {
    $profile =  IsNullOrEmptyString($_SESSION['profile']) ? "assets/logo/placeholder-profile-male.jpg" : $_SESSION['profile'];

    $reserve_rent = $_SESSION['type'] == 'Employee' ? "Reserve" : "Rent";
    $_SESSION['type'] == 'e' ? $title = "Reserve" : "Rent";
    $name = '<span class="glyphicon glyphicon-user"></span>' . "&nbsp;&nbsp;&nbsp;" . $_SESSION['name'];
}


$content = '
<row>
<div class="center center-text">
    <h3>Kiran Gautam</h3>
    <img src= '. $profile . ' alt="ProfilePic">
    <form  action= "utilities/upload.php" method="post" enctype="multipart/form-data" >
        <input type="hidden" name="MAX_FILE_SIZE" value="4194304" />
        <input type="file" required accept="image/*" name="fileToUpload" id="fileToUpload" align="center" class="center-text left20x">
        <input type="submit" value="Upload Image" name="submit">
    </form>
</div>
</row>
';


include 'template.php';

?>
