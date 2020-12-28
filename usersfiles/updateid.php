<?php

include('bd.php');

$id = $_GET['id'];
$nick = $_GET['nick'];
$server = $_GET['server'];

if ($server == "Red") {
	mysql_query("UPDATE `UsersRed` SET `id` = '$id' WHERE `Nick` = '$nick'") or die(mysql_error());
	mysql_query("UPDATE `UsersLK` SET `account` = '$id' WHERE `nickname_account` = '$nick'") or die(mysql_error());
	mysql_query("UPDATE `Donaterang` SET `id` = '$id' WHERE `Nick` = '$nick' AND `server` = '$server'") or die(mysql_error());
}

if ($server == "Green") {
	mysql_query("UPDATE `UsersGreen` SET `id` = '$id' WHERE `Nick` = '$nick'") or die(mysql_error());
	mysql_query("UPDATE `UsersLK` SET `account` = '$id' WHERE `nickname_account` = '$nick'") or die(mysql_error());
	mysql_query("UPDATE `Donaterang` SET `id` = '$id' WHERE `Nick` = '$nick' AND `server` = '$server'") or die(mysql_error());
}

if ($server == "Blue") {
	mysql_query("UPDATE `UsersBlue` SET `id` = '$id' WHERE `Nick` = '$nick'") or die(mysql_error());
	mysql_query("UPDATE `UsersLK` SET `account` = '$id' WHERE `nickname_account` = '$nick'") or die(mysql_error());
	mysql_query("UPDATE `Donaterang` SET `id` = '$id' WHERE `Nick` = '$nick' AND `server` = '$server'") or die(mysql_error());
}

if ($server == "Lime") {
	mysql_query("UPDATE `UsersLime` SET `id` = '$id' WHERE `Nick` = '$nick'") or die(mysql_error());
	mysql_query("UPDATE `UsersLK` SET `account` = '$id' WHERE `nickname_account` = '$nick'") or die(mysql_error());
	mysql_query("UPDATE `Donaterang` SET `id` = '$id' WHERE `Nick` = '$nick' AND `server` = '$server'") or die(mysql_error());
}

?>