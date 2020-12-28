<?php

include('bd.php');

$id = $_GET['id'];
$server = $_GET['server'];

if ($server == "Red") {
	$result = mysql_query("SELECT * FROM `UsersRed` WHERE `id` = '$id'") or die(mysql_error());
	$myrow = mysql_fetch_array($result);
}
if ($server == "Green") {
	$result = mysql_query("SELECT * FROM `UsersGreen` WHERE `id` = '$id'") or die(mysql_error());
	$myrow = mysql_fetch_array($result);
}
if ($server == "Blue") {
	$result = mysql_query("SELECT * FROM `UsersBlue` WHERE `id` = '$id'") or die(mysql_error());
	$myrow = mysql_fetch_array($result);
}
if ($server == "Lime") {
	$result = mysql_query("SELECT * FROM `UsersLime` WHERE `id` = '$id'") or die(mysql_error());
	$myrow = mysql_fetch_array($result);
}

echo "" .$myrow['donate'];

?>