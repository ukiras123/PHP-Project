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

if (!isset($_POST['rId'])) {
    $aResult['error'] = 'No RId';
}

if (!isset($aResult['error'])) {

    $query = $rent_resource;
    session_start();
    $uID = $_SESSION['uID'];
    $rId = $_POST['rId'];
    $startDate = $endDate = "";
    $rent_result = 0;

    if (isset($_COOKIE["startDate"])) {
        $startDate = $_COOKIE["startDate"];
    }

    if (isset($_COOKIE["endDate"])) {
        $endDate = $_COOKIE["endDate"];
    }

    $query = replaceFromHaystack($query, "?", $uID);
    $query = replaceFromHaystack($query, "?", $rId);
    $query = replaceFromHaystack($query, "?", $startDate);
    $sql = replaceFromHaystack($query, "?", $endDate);

    $link = getDBLink();


    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if ($stmt = mysqli_prepare($link, $get_proc_result)) {
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                // Fetch result rows as an associative array
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $rent_result = $row["success"];
                }
            }
            mysqli_stmt_close($stmt);
        }
    }

    if ($rent_result == 1) {
        setcookie("bookSuccess", true, time() + (86400 * 30), "/"); // 86400 = 1 day
        $aResult['result'] = "success";
    } else {
        setcookie("bookSuccess", false, time() + (86400 * 30), "/"); // 86400 = 1 day
        $aResult['error'] = "failure" . $sql;
    }
    echo json_encode($aResult);

} else {
    $aResult['error'] = 'Something went wrong';
    echo json_encode($aResult);

}


?>