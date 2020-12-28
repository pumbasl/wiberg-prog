<?php

include('bd.php');

$Nick = $_GET['Nick'];
$server = $_GET['server'];

if ($server == "Red") {
	$result = mysql_query("SELECT * FROM `UsersRed` WHERE `Nick` = '$Nick'") or die(mysql_error());
	$myrow = mysql_fetch_array($result);

	if (empty($myrow['Nick'])){
		echo "False";
	}
	else{
		echo "True";
	}
}

if ($server == "Green") {
	$result = mysql_query("SELECT * FROM `UsersGreen` WHERE `Nick` = '$Nick'") or die(mysql_error());
	$myrow = mysql_fetch_array($result);

	if (empty($myrow['Nick'])){
		echo "False";
	}
	else{
		echo "True";
	}
}

if ($server == "Blue") {
	$result = mysql_query("SELECT * FROM `UsersBlue` WHERE `Nick` = '$Nick'") or die(mysql_error());
	$myrow = mysql_fetch_array($result);

	if (empty($myrow['Nick'])){
		echo "False";
	}
	else{
		echo "True";
	}
}

if ($server == "Lime") {
	$result = mysql_query("SELECT * FROM `UsersLime` WHERE `Nick` = '$Nick'") or die(mysql_error());
	$myrow = mysql_fetch_array($result);

	if (empty($myrow['Nick'])){
		echo "False";
	}
	else{
		echo "True";
	}
}

?>