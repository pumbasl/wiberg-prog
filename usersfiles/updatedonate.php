<?php

include('bd.php');

$id = $_GET['id'];
$donate = $_GET['donate'];
$server = $_GET['server']

if ($server == "Red") {
	mysql_query("UPDATE `UsersRed` SET `donate` = '$donate' WHERE `id` = '$id'") or die(mysql_error());
}

if ($server == "Green") {
	mysql_query("UPDATE `UsersGreen` SET `donate` = '$donate' WHERE `id` = '$id'") or die(mysql_error());
}

if ($server == "Blue") {
	mysql_query("UPDATE `UsersBlue` SET `donate` = '$donate' WHERE `id` = '$id'") or die(mysql_error());
}

if ($server == "Lime") {
	mysql_query("UPDATE `UsersLime` SET `donate` = '$donate' WHERE `id` = '$id'") or die(mysql_error());
}

?>