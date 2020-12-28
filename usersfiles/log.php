<?php

include('bd.php');

$nick = $_GET['Nick'];
$vers = $_GET['vers'];
$frak = $_GET['frak'];
$date = $_GET['date'];
$time = $_GET['time'];

mysql_set_charset("cp1251");
mysql_query("INSERT INTO `Login` (`Nick`, `Version`, `Frak`, `Data`, `Time`) VALUES ('$nick', '$vers', '$frak', '$date', '$time')") or die(mysql_error());

?>