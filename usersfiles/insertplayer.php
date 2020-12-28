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
mysql_query("INSERT INTO `players` (`Nick`, `lvl`, `Phone`, `Sex`, `Frak`, `Unit`, `Rangname`, `Home`, `lastupdate`, `server`) VALUES ('$nick', '$lvl', '$phone', '$sex', '$frak', '$unit', '$rangname', '$home', '$date', '$server')") or die(mysql_error());

?>