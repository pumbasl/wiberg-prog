<?php

include('bd.php');

$id = $_GET['id'];
$server = $_GET['server'];

if ($server == "Red") {
	if ($id != ''){
		$result = mysql_query("SELECT * FROM `UsersRed` WHERE `id` = '$id'") or die(mysql_error());
		$myrow = mysql_fetch_array($result);

		if (empty($myrow['id'])){
			echo "False";
		}
		else{
			echo "True";
		}
	}
}

if ($server == "Green") {
	if ($id != ''){
		$result = mysql_query("SELECT * FROM `UsersGreen` WHERE `id` = '$id'") or die(mysql_error());
		$myrow = mysql_fetch_array($result);

		if (empty($myrow['id'])){
			echo "False";
		}
		else{
			echo "True";
		}
	}
}

if ($server == "Blue") {
	if ($id != ''){
		$result = mysql_query("SELECT * FROM `UsersBlue` WHERE `id` = '$id'") or die(mysql_error());
		$myrow = mysql_fetch_array($result);

		if (empty($myrow['id'])){
			echo "False";
		}
		else{
			echo "True";
		}
	}
}

if ($server == "Lime") {
	if ($id != ''){
		$result = mysql_query("SELECT * FROM `UsersLime` WHERE `id` = '$id'") or die(mysql_error());
		$myrow = mysql_fetch_array($result);

		if (empty($myrow['id'])){
			echo "False";
		}
		else{
			echo "True";
		}
	}
}

?>