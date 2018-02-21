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


$searchcomputer = "select * from Computer";

$searchmicrophone = "select * from Microphone";

$searchprojector = "select * from Projector";

$searchroom = "select * from Room";


$bookresource ="insert into user_resources
set rId = ?, uId = (select uId from users where username = '?'),
startdatetime = '?', enddatetime = '?'";

?>