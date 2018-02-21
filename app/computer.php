<?php

require_once 'utilities/generic-function.php';
require_once 'utilities/query.php';


$title = "Computer Resources";
$reserve_rent = "";
$name = "";
$content = "";
$reserveActive = "";
$reportActive = "";
$profileActive = "";
$indexActive = "active";
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
    $nameWthLogo = '<span class="glyphicon glyphicon-user"></span>' ."&nbsp;&nbsp;&nbsp;". $_SESSION['username'];
}
$content = getResourceDropdown();
$content = $content . getComputerDetails($allcomputerdetail);

include 'template.php';

?>
