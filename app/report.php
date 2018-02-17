<?php
$title = "Report";
$reserve_rent = "";
$name = "";
$content = "";
$reserveActive = "";
$reportActive = "active";
$profileActive = "";
$indexActive = "";

session_start();
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: userlogin/login.php");
    exit;
} else
{
    $reserve_rent = $_SESSION['type'] == 'Employee' ? "Reserve" : "Rent";
    $_SESSION['type'] == 'e' ? $title = "Reserve" : "Rent";
    $nameWthLogo = '<span class="glyphicon glyphicon-user"></span>' ."&nbsp;&nbsp;&nbsp;". $_SESSION['name'];
}

include 'template.php';

?>
