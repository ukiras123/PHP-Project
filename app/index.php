<?php

require_once 'utilities/generic-function.php';


$title = "Index";
$reserve_rent = "";
$name = "";
$content = "";
$reserveActive = "";
$reportActive = "";
$profileActive = "";
$indexActive = "active";

session_start();
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: userlogin/login.php");
    exit;
} else
{
    $reserve_rent = $_SESSION['type'] == 'employee' ? "Reserve" : "Rent";
    $nameWthLogo = '<span class="glyphicon glyphicon-user"></span>' ."&nbsp;&nbsp;&nbsp;". $_SESSION['username'];
}
$content = getResourceDropdown().
'<img src="assets/logo/backgroundPic.jpg" class="image-size top5x img-rounded img-responsive" alt="Parterns">';

include 'template.php';

?>
