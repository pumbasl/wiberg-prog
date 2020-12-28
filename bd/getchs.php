<?php

include('bd.php');

$server = $_GET['server'];

if ($server == "Red") {
	$result = mysql_query("SELECT * FROM `info` WHERE `newid` = '1'", $db) or die(mysql_error());
	$myrow = mysql_fetch_array($result);
	echo "" .$myrow['id'];
}

if ($server == "Green") {
	$result = mysql_query("SELECT * FROM `info` WHERE `newid` = '6'", $db) or die(mysql_error());
	$myrow = mysql_fetch_array($result);
	echo "" .$myrow['id'];
}

if ($server == "Blue") {
	$result = mysql_query("SELECT * FROM `info` WHERE `newid` = '7'", $db) or die(mysql_error());
	$myrow = mysql_fetch_array($result);
	echo "" .$myrow['id'];
}

if ($server == "Lime") {
	$result = mysql_query("SELECT * FROM `info` WHERE `newid` = '8'", $db) or die(mysql_error());
	$myrow = mysql_fetch_array($result);
	echo "" .$myrow['id'];
}

?>