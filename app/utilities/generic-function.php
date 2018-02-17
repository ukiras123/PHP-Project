<?php
function IsNullOrEmptyString($str){
    return (!isset($str) || trim($str)==='');
}
?>