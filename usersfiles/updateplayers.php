<?php

include('bd.php');

$nick = $_GET['nick'];
$lvl = $_GET['lvl'];
$phone = $_GET['phone'];
$sex = $_GET['sex'];
$frak = $_GET['frak'];
$unit = $_GET['unit'];
$rangname = $_GET['rangname'];
$home = $_GET['home'];
$date = $_GET['date'];
$server = $_GET['server'];

mysql_set_charset("UTF8");
mysql_query("UPDATE `players` SET `Nick` = '$nick', `lvl` = '$lvl', `Phone` = '$phone', `Sex` = '$sex', `Frak` = '$frak', `Unit` = '$unit', `Rangname` = '$rangname', `Home` = '$home', `lastupdate` = '$date', `server` = '$server' WHERE `Nick` = '$nick' AND `server` = '$server'") or die(mysql_error());

?>