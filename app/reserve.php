<?php

require_once 'utilities/generic-function.php';
require_once 'utilities/query.php';

$title = "";
$reserve_rent = "";
$name = "";
$content = "";
$reserveActive = "active";
$reportActive = "";
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
    $title = $_SESSION['type'] == 'employee' ? "Reserve" : "Rent";
    $nameWthLogo = '<span class="glyphicon glyphicon-user"></span>' ."&nbsp;&nbsp;&nbsp;". $_SESSION['username'];
}
$additionalHead = '<link rel="stylesheet" href="assets/style/reserve.css">';

$startDate = $endDate = $computerselected = $microphoneselected = $projectorselected = $roomselected = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $startDate = isset($_POST["startDate"]) ?  'value = "' . $_POST["startDate"].'"' : "";
    $endDate =   isset($_POST["endDate"]) ? 'value = "' .$_POST["endDate"].'"' : "";

    setcookie("startDate", $_POST["startDate"], time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie("endDate", $_POST["endDate"], time() + (86400 * 30), "/"); // 86400 = 1 day

    if(isset($_POST["type"])) {
        if ($_POST["type"] == "computer") {
            $searchcomputer = replaceFromHaystack($searchcomputer, "?", $_POST["endDate"]);
            $searchcomputer = replaceFromHaystack($searchcomputer, "?", $_POST["startDate"]);
            $content2 = getComputerDetails($searchcomputer, true);
            $computerselected = 'selected="selected"';
        } elseif (isset($_POST["type"]) && $_POST["type"] == "microphone") {
            $searchmicrophone = replaceFromHaystack($searchmicrophone, "?", $_POST["endDate"]);
            $searchmicrophone = replaceFromHaystack($searchmicrophone, "?", $_POST["startDate"]);
            $content2 = getMicrophoneDetail($searchmicrophone, true);
            $microphoneselected = 'selected="selected"';
        } elseif (isset($_POST["type"]) && $_POST["type"] == "room") {
            $searchroom = replaceFromHaystack($searchroom, "?", $_POST["endDate"]);
            $searchroom = replaceFromHaystack($searchroom, "?", $_POST["startDate"]);
            $content2 = getRoomDetail($searchroom, true);
            $roomselected = 'selected="selected"';
        } elseif (isset($_POST["type"]) && $_POST["type"] == "projector") {
            $searchprojector = replaceFromHaystack($searchprojector, "?", $_POST["endDate"]);
            $searchprojector = replaceFromHaystack($searchprojector, "?", $_POST["startDate"]);
            $content2 = getProjectorDetail($searchprojector, true);
            $projectorselected = 'selected="selected"';
        }
    }
}





$content = '
<div id="loader" class="loader center" hidden></div>

<div id="pass" class="alert alert-success" hidden>
        <strong>Success!</strong> Successfully Booked. You can view confirmation on your profile history.
 </div>
 
 <div id="fail" class="alert alert-danger" hidden>
        <strong>Failed!</strong> Something went wrong! Please try again.
 </div>
    
<form action="" method="post"> 
<div class="row">

    <div class="form-group col-xs-4 col-md-4">
    
        <label for="type" class="control-label">Resource Type</label>
          <select class="form-control" name="type" id="type">
            <option '.$computerselected.'value = "computer">Computer</option>
            <option '.$microphoneselected.'value = "microphone">Microphone</option>
            <option '.$projectorselected.'value = "projector">Projector</option>
            <option '.$roomselected.'value = "room">Room</option>
        </select>
        
     </div>
    <div class="form-group col-xs-4 col-md-4">
        <label for="startDate" class="control-label">Select Start Date</label>
      <input required type="datetime-local" '.  $startDate .' class="form-control" id="startDate" name="startDate">
    </div>
    
    <div class="form-group col-xs-4 col-md-4">
        <label for="endDate" class="control-label">Select End Date</label>
      <input required type="datetime-local" '.  $endDate .'class="form-control" id="endDate" name="endDate">
    </div>
    
   
</div>
    
    <button type="submit" class="btn btn-primary">Get Available Resource</button>
</form>

';



include 'template.php';

?>
