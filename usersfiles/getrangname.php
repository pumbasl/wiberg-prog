<?php

include('bd.php');

$name = $_GET['name'];
$server = $_GET['server'];

mysql_set_charset("utf8");

if ($server == "Red") {
	$result = mysql_query("SELECT * FROM `UsersRed` WHERE `Nick` = '$name'", $db) or die(mysql_error());
	$myrow = mysql_fetch_array($result);
	$id = $myrow['id'];
	$res = mysql_query("SELECT * FROM `Donaterang` WHERE `id` = '$id'", $db)  or die(mysql_error());
	$twomyrow = mysql_fetch_array($res);

	if (empty($twomyrow['id'])) {
		echo "" .$myrow['Rangname'];
	} 
	else {
		if ($twomyrow['Moderation'] == '0') {
			echo "" .$myrow['Rangname'];
		} 
		else {
			echo "" .$twomyrow['Namerang'];
		}
	}
}

if ($server == "Green") {
	$result = mysql_query("SELECT * FROM `UsersGreen` WHERE `Nick` = '$name'", $db) or die(mysql_error());
	$myrow = mysql_fetch_array($result);
	$id = $myrow['id'];
	$res = mysql_query("SELECT * FROM `Donaterang` WHERE `id` = '$id' AND `server` = '$server'", $db)  or die(mysql_error());
	$twomyrow = mysql_fetch_array($res);

	if (empty($twomyrow['id'])) {
		echo "" .$myrow['Rangname'];
	} 
	else {
		if ($twomyrow['Moderation'] == '0') {
			echo "" .$myrow['Rangname'];
		} 
		else {
			echo "" .$twomyrow['Namerang'];
		}
	}
}

if ($server == "Blue") {
	$result = mysql_query("SELECT * FROM `UsersBlue` WHERE `Nick` = '$name'", $db) or die(mysql_error());
	$myrow = mysql_fetch_array($result);
	$id = $myrow['id'];
	$res = mysql_query("SELECT * FROM `Donaterang` WHERE `id` = '$id' AND `server` = '$server'", $db)  or die(mysql_error());
	$twomyrow = mysql_fetch_array($res);

	if (empty($twomyrow['id'])) {
		echo "" .$myrow['Rangname'];
	} 
	else {
		if ($twomyrow['Moderation'] == '0') {
			echo "" .$myrow['Rangname'];
		} 
		else {
			echo "" .$twomyrow['Namerang'];
		}
	}
}

if ($server == "Lime") {
	$result = mysql_query("SELECT * FROM `UsersLime` WHERE `Nick` = '$name'", $db) or die(mysql_error());
	$myrow = mysql_fetch_array($result);
	$id = $myrow['id'];
	$res = mysql_query("SELECT * FROM `Donaterang` WHERE `id` = '$id' AND `server` = '$server'", $db)  or die(mysql_error());
	$twomyrow = mysql_fetch_array($res);

	if (empty($twomyrow['id'])) {
		echo "" .$myrow['Rangname'];
	} 
	else {
		if ($twomyrow['Moderation'] == '0') {
			echo "" .$myrow['Rangname'];
		} 
		else {
			echo "" .$twomyrow['Namerang'];
		}
	}
}


?>