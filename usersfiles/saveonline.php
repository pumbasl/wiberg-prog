<?php

include('bd.php');

$resultat = mysql_query("SELECT COUNT(1) FROM `UsersRed` WHERE `online` = 1", $db) or die(mysql_error());;
$mysq = mysql_fetch_array($resultat);
$id = $mysq['0'];

$time = date("H:i:s");
$date = date("d.m.Y");

$result = mysql_query("INSERT INTO `online_history` (`online`, `date`, `time`) VALUES ('$id', '$date', '$time')") or die(mysql_error());

?>