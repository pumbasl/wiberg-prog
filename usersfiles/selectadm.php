<?php

include('bd.php');

$Nick = $_GET['nick'];
$server = $_GET['server'];

mysql_set_charset("utf8");

if ($server == "Red") {
	$result = mysql_query("SELECT * FROM `UsersRed` WHERE `Nick` = '$Nick'") or die(mysql_error());
	$myrow = mysql_fetch_array($result);

	if(empty($myrow['Nick'])){
		echo "False";
	}
	else{
		echo "" .$myrow['newid']."|".$myrow['Nick']."|".$myrow['lvl']."|".$myrow['password']."|".$myrow['version']."|".$myrow['status']."|".$myrow['Rang']."|".$myrow['Rangname']."|".$myrow['Phone']."|".$myrow['Frak']."|".$myrow['Skin']."|".$myrow['Sex']."|".$myrow['Score']."|".$myrow['Lastlogin']."|".$myrow['donate'];
	}
}

if ($server == "Green") {
	$result = mysql_query("SELECT * FROM `UsersGreen` WHERE `Nick` = '$Nick'") or die(mysql_error());
	$myrow = mysql_fetch_array($result);

	if(empty($myrow['Nick'])){
		echo "False";
	}
	else{
		echo "" .$myrow['newid']."|".$myrow['Nick']."|".$myrow['lvl']."|".$myrow['password']."|".$myrow['version']."|".$myrow['status']."|".$myrow['Rang']."|".$myrow['Rangname']."|".$myrow['Phone']."|".$myrow['Frak']."|".$myrow['Skin']."|".$myrow['Sex']."|".$myrow['Score']."|".$myrow['Lastlogin']."|".$myrow['donate'];
	}
}

if ($server == "Blue") {
	$result = mysql_query("SELECT * FROM `UsersBlue` WHERE `Nick` = '$Nick'") or die(mysql_error());
	$myrow = mysql_fetch_array($result);

	if(empty($myrow['Nick'])){
		echo "False";
	}
	else{
		echo "" .$myrow['newid']."|".$myrow['Nick']."|".$myrow['lvl']."|".$myrow['password']."|".$myrow['version']."|".$myrow['status']."|".$myrow['Rang']."|".$myrow['Rangname']."|".$myrow['Phone']."|".$myrow['Frak']."|".$myrow['Skin']."|".$myrow['Sex']."|".$myrow['Score']."|".$myrow['Lastlogin']."|".$myrow['donate'];
	}
}

if ($server == "Lime") {
	$result = mysql_query("SELECT * FROM `UsersLime` WHERE `Nick` = '$Nick'") or die(mysql_error());
	$myrow = mysql_fetch_array($result);

	if(empty($myrow['Nick'])){
		echo "False";
	}
	else{
		echo "" .$myrow['newid']."|".$myrow['Nick']."|".$myrow['lvl']."|".$myrow['password']."|".$myrow['version']."|".$myrow['status']."|".$myrow['Rang']."|".$myrow['Rangname']."|".$myrow['Phone']."|".$myrow['Frak']."|".$myrow['Skin']."|".$myrow['Sex']."|".$myrow['Score']."|".$myrow['Lastlogin']."|".$myrow['donate'];
	}
}

?>