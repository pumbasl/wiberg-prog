<?php

include('bd.php');

$version = $_GET['version'];
$nick = $_GET['nick'];
$status = $_GET['status'];
$rang = $_GET['rang'];
$rangname = $_GET['rangname'];
$phone = $_GET['phone'];
$frak = $_GET['frak'];
$skin = $_GET['skin'];
$sex = $_GET['sex'];
$id = $_GET['id'];
$lastlogin = $_GET['lastlogin'];
$server = $_GET['server'];

mysql_set_charset("UTF8");

if ($server == "Red") {
	$result = mysql_query("INSERT INTO `UsersRed` (`version`, `Nick`, `status`, `Rang`, `Rangname`, `Phone`, `Frak`, `skin`, `Sex`, `id`) VALUES ('$version', '$nick', '$status', '$rang', '$rangname', '$phone', '$frak', '$skin', '$sex', '$id')") or die(mysql_error());
}

if ($server == "Green") {
	$result = mysql_query("INSERT INTO `UsersGreen` (`version`, `Nick`, `status`, `Rang`, `Rangname`, `Phone`, `Frak`, `skin`, `Sex`, `id`) VALUES ('$version', '$nick', '$status', '$rang', '$rangname', '$phone', '$frak', '$skin', '$sex', '$id')") or die(mysql_error());
}

if ($server == "Blue") {
	$result = mysql_query("INSERT INTO `UsersBlue` (`version`, `Nick`, `status`, `Rang`, `Rangname`, `Phone`, `Frak`, `skin`, `Sex`, `id`) VALUES ('$version', '$nick', '$status', '$rang', '$rangname', '$phone', '$frak', '$skin', '$sex', '$id')") or die(mysql_error());
}

if ($server == "Lime") {
	$result = mysql_query("INSERT INTO `UsersLime` (`version`, `Nick`, `status`, `Rang`, `Rangname`, `Phone`, `Frak`, `skin`, `Sex`, `id`) VALUES ('$version', '$nick', '$status', '$rang', '$rangname', '$phone', '$frak', '$skin', '$sex', '$id')") or die(mysql_error());
}

?>