<?php
$title = "";
$reserve_rent = "";
$name = "";
$content = "";
$reserveActive = "active";
$reportActive = "";
$profileActive = "";
$indexActive = "";

session_start();
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: userlogin/login.php");
    exit;
} else
{
    $reserve_rent = $_SESSION['type'] == 'employee' ? "Reserve" : "Rent";
    $_SESSION['type'] == 'employee' ? $title = "Reserve" : "Rent";
    $nameWthLogo = '<span class="glyphicon glyphicon-user"></span>' ."&nbsp;&nbsp;&nbsp;". $_SESSION['username'];
}

include 'template.php';

?>
