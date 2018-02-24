<?php

require_once 'utilities/generic-function.php';
require_once 'utilities/query.php';

$title = "Report";
$reserve_rent = "";
$name = "";
$content = "";
$reserveActive = "";
$reportActive = "active";
$profileActive = "";
$indexActive = "";
$additionalHead = "";
$content2 = "";

session_start();
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: userlogin/login.php");
    exit;
} else
{
    $reserve_rent = $_SESSION['type'] == 'employee' ? "Reserve" : "Rent";
    $_SESSION['type'] == 'e' ? $title = "Reserve" : "Rent";
    $nameWthLogo = '<span class="glyphicon glyphicon-user"></span>' ."&nbsp;&nbsp;&nbsp;". $_SESSION['username'];
}

$additionalHead = '<!--===============================================================================================-->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/style/table/util.css">
	<link rel="stylesheet" type="text/css" href="assets/style/table/main.css">
<!--===============================================================================================-->
';


$content2 = getReport($report);


include 'template.php';

?>
