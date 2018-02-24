<?php
require_once 'utilities/generic-function.php';
require_once 'utilities/query.php';

$title = "My History";
$reserve_rent = "";
$name = "";
$content = "";
$reserveActive = "";
$reportActive = "";
$profileActive = "active";
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

$userHistory = replaceFromHaystack($userhistory, "?", $_SESSION['username']);

$content = '
<div id="loader" class="loader center" hidden></div>

<div id="pass" class="alert alert-success" hidden>
        <strong>Success!</strong> Successfully deleted the selected resource.
 </div>
 
 <div id="fail" class="alert alert-danger" hidden>
        <strong>Failed!</strong> Couldn not delete the selected resource, please try again later.
 </div>
 
';

$content2 = getUserReservation($userHistory);
include 'template.php';

?>
