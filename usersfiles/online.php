<?php

include('bd.php');

$id = $_GET['id'];
$onl = $_GET['onl'];
$server = $_GET['server'];

if ($server == "Red") {
	mysql_query("UPDATE `UsersRed` SET `online` = '$onl' WHERE `id` = '$id'") or die(mysql_error());
}

if ($server == "Green") {
	mysql_query("UPDATE `UsersGreen` SET `online` = '$onl' WHERE `id` = '$id'") or die(mysql_error());
}

if ($server == "Blue") {
	mysql_query("UPDATE `UsersBlue` SET `online` = '$onl' WHERE `id` = '$id'") or die(mysql_error());
}

if ($server == "Lime") {
	mysql_query("UPDATE `UsersLime` SET `online` = '$onl' WHERE `id` = '$id'") or die(mysql_error());
}

?>