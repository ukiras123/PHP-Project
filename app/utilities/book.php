<?php
/**
 * Created by PhpStorm.
 * User: Kiran
 * Date: 2/19/18
 * Time: 11:52 PM
 */
header('Content-Type: application/json');

require_once 'query.php';
require_once 'generic-function.php';

$aResult = array();

if( !isset($_POST['rId']) ) { $aResult['error'] = 'No RId'; }

if( !isset($aResult['error']) ) {

    $query = $bookresource;
    session_start();
    $username = $_SESSION['username'];
    $rId = $_POST['rId'];
    $startDate = $endDate = "";

    if (isset($_COOKIE["startDate"])) {
        $startDate = $_COOKIE["startDate"];
    }

    if (isset($_COOKIE["endDate"])) {
        $endDate = $_COOKIE["endDate"];
    }

    $query = replaceFromHaystack($query, "?", $rId);
    $query = replaceFromHaystack($query, "?", $username);
    $query = replaceFromHaystack($query, "?", $startDate);
    $sql = replaceFromHaystack($query, "?", $endDate);

    $link = getDBLink();
    if ($result = mysqli_query($link, $sql)) {
        mysqli_close($link);
        setcookie("bookSuccess", true, time() + (86400 * 30), "/"); // 86400 = 1 day
        $aResult['result'] = "success";
    } else {
        $aResult['error'] = 'Something went wrong';
    }
    echo json_encode($aResult);
}











?>