<?php

require_once 'utilities/generic-function.php';


$title = "Room Resources";
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
    $reserve_rent = $_SESSION['type'] == 'Employee' ? "Reserve" : "Rent";
    $nameWthLogo = '<span class="glyphicon glyphicon-user"></span>' ."&nbsp;&nbsp;&nbsp;". $_SESSION['username'];
}
$content = getResourceDropdown();
$content = $content . getRoomDetail();

include 'template.php';

?>
