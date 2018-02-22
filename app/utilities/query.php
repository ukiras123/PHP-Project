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


$bookresource ="insert into user_resources
set rId = ?, uId = (select uId from users where username = '?'),
startdatetime = '?', enddatetime = '?'";

?>