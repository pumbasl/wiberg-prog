<?php

include('bd.php');

$id = $_GET['id'];
$score = $_GET['score'];
$server = $_GET['server'];

if ($server == "Red") {
	mysql_query("UPDATE `UsersRed` SET `Score` = '$score' WHERE `id` = '$id'") or die(mysql_error());
}

if ($server == "Green") {
	mysql_query("UPDATE `UsersGreen` SET `Score` = '$score' WHERE `id` = '$id'") or die(mysql_error());
}

if ($server == "Blue") {
	mysql_query("UPDATE `UsersBlue` SET `Score` = '$score' WHERE `id` = '$id'") or die(mysql_error());
}

if ($server == "Lime") {
	mysql_query("UPDATE `UsersLime` SET `Score` = '$score' WHERE `id` = '$id'") or die(mysql_error());
}

?>