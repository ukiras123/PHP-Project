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

    $query = $remove_resource;
    session_start();
    $rId = $_POST['rId'];
    $rent_result = 0;

    $sql = replaceFromHaystack($query, "?", $rId);
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
        $aResult['result'] = "success";
    } else {
        $aResult['error'] = "failure it" + $sql ;
    }
    echo json_encode($aResult);

} else {
    $aResult['error'] = 'Something went wrong';
    echo json_encode($aResult);

}


?>