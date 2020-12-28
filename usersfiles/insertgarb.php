<?php

include('bd.php');

$nick = $_GET['Nick'];
$Nickgive = $_GET['Nickgive'];
$amount = $_GET['amount'];
$Reason = $_GET['Reason'];
$Date = $_GET['Date'];
$time = $_GET['time'];

mysql_set_charset("utf8");
mysql_query("INSERT INTO `garb` (`Nick`, `Nickgive`, `amount`, `Reason`, `Date`, `Time`) VALUES ('$nick', '$Nickgive', '$amount', '$Reason', '$Date', '$time')") or die(mysql_error());

?>