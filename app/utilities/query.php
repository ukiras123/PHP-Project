<?php
/**
 * Created by PhpStorm.
 * User: Kiran
 * Date: 2/19/18
 * Time: 9:14 PM
 */
$allroomdetail = "select r.type, ro.name, ro.roomnum, ro.capacity, r.description from resources r inner join room ro
on ro.rID = r.rId";

$allcomputerdetail = "select r.type, c.manufacturer, c.model, c.os, c. serialnum, r.description from resources r inner join computer c
on c.rID = r.rId";

$allmicrophonedetail = "select r.type, m.manufacturer, m.model, m.serialnum, r.description from resources r inner join microphone m
on m.rID = r.rId";

$allprojectordetail = "select r.type, p.manufacturer, p.model, p.serialnum, r.description from resources r inner join projector p
on p.rID = r.rId";


$searchcomputer = "select distinct c. serialnum, r.type, c.manufacturer, c.model, c.os,  r.description  from resources r inner join computer c 
on c.rId = r.rId
left join user_resources ur
on r.rId = ur.rId
and startdatetime IS NULL
OR ('?' < enddatetime
      AND '?'  > startdatetime)";

$searchmicrophone = "select distinct m.serialnum, r.type, m.manufacturer, m.model,  r.description from resources r inner join microphone m
on m.rId = r.rId
left join user_resources ur
on r.rId = ur.rId
and startdatetime IS NULL
OR ('?' < enddatetime
      AND '?'   > startdatetime)";

$searchprojector = "select distinct p.serialnum, r.type, p.manufacturer, p.model,  r.description from resources r inner join projector p
on p.rId = r.rId
left join user_resources ur
on r.rId = ur.rId
and startdatetime IS NULL
OR ('?' < enddatetime
      AND '?'   > startdatetime)";

$searchroom = "select distinct ro.roomnum, r.type, ro.name, ro.capacity, r.description from resources r inner join room ro
on ro.rId = r.rId
left join user_resources ur
on r.rId = ur.rId
and startdatetime IS NULL
OR ('?' < enddatetime
      AND '?'   > startdatetime)";


?>