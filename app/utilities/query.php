<?php
/**
 * Created by PhpStorm.
 * User: Kiran
 * Date: 2/19/18
 * Time: 9:14 PM
 */
$allroomdetail = "select * from Room";

$allcomputerdetail = "select * from Computer";

$allmicrophonedetail = "select * from Microphone";

$allprojectordetail = "select * from Projector";


$searchcomputer = "CALL available_computers(CAST('?' AS DATETIME), CAST('?' AS DATETIME))";

$searchmicrophone = "CALL available_microphones(CAST('?' AS DATETIME), CAST('?' AS DATETIME))";

$searchprojector = "CALL available_projectors(CAST('?' AS DATETIME), CAST('?' AS DATETIME))";

$searchroom = "CALL available_rooms(CAST('?' AS DATETIME), CAST('?' AS DATETIME))";

$userhistory = "select * from v_rental where username = '?' order by start_date desc";

$report = "CALL total_use_by_resource ()";


$rent_resource ="call app.rent_resource (?, ?, CAST('?' AS DATETIME), CAST('?' AS DATETIME), @success)";  //uID, rID, fromDate, toDate
$remove_resource ="call app.remove_rental (?, @success)";  //rentalID
$get_proc_result = "select @success as success";


?>