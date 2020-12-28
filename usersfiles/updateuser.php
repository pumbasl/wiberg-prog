<?php

include('bd.php');

$version = $_GET['version'];
$nick = $_GET['nick'];
$lvl = $_GET['lvl'];
$status = $_GET['status'];
$rang = $_GET['rang'];
$rangname = $_GET['rangname'];
$phone = $_GET['phone'];
$frak = $_GET['frak'];
$skin = $_GET['skin'];
$sex = $_GET['sex'];
$id = $_GET['id'];
$lastlogin = $_GET['lastlogin'];
$server = $_GET['server'];

mysql_set_charset("UTF8");

if ($server == "Red") {
	$result = mysql_query("UPDATE `UsersRed` SET `version` = '$version', `Nick` = '$nick', `lvl` = '$lvl',`status` = '$status', `Rang` = '$rang', `Rangname` = '$rangname', `Phone` = '$phone', `Frak` = '$frak', `skin` = '$skin', `Sex` = '$sex', `Lastlogin` = '$lastlogin', `id` = '$id' WHERE `id` = '$id'") or die(mysql_error());
	mysql_query("UPDATE `Donaterang` SET `Nick` = '$nick' WHERE `id` = '$id' AND `server` = '$server'") or die(mysql_error());
}

if ($server == "Green") {
	$result = mysql_query("UPDATE `UsersGreen` SET `version` = '$version', `Nick` = '$nick', `lvl` = '$lvl',`status` = '$status', `Rang` = '$rang', `Rangname` = '$rangname', `Phone` = '$phone', `Frak` = '$frak', `skin` = '$skin', `Sex` = '$sex', `Lastlogin` = '$lastlogin', `id` = '$id' WHERE `id` = '$id'") or die(mysql_error());
	mysql_query("UPDATE `Donaterang` SET `Nick` = '$nick' WHERE `id` = '$id' AND `server` = '$server'") or die(mysql_error());
}

if ($server == "Blue") {
	$result = mysql_query("UPDATE `UsersBlue` SET `version` = '$version', `Nick` = '$nick', `lvl` = '$lvl',`status` = '$status', `Rang` = '$rang', `Rangname` = '$rangname', `Phone` = '$phone', `Frak` = '$frak', `skin` = '$skin', `Sex` = '$sex', `Lastlogin` = '$lastlogin', `id` = '$id' WHERE `id` = '$id'") or die(mysql_error());
	mysql_query("UPDATE `Donaterang` SET `Nick` = '$nick' WHERE `id` = '$id' AND `server` = '$server'") or die(mysql_error());
}

if ($server == "Lime") {
	$result = mysql_query("UPDATE `UsersLime` SET `version` = '$version', `Nick` = '$nick', `lvl` = '$lvl',`status` = '$status', `Rang` = '$rang', `Rangname` = '$rangname', `Phone` = '$phone', `Frak` = '$frak', `skin` = '$skin', `Sex` = '$sex', `Lastlogin` = '$lastlogin', `id` = '$id' WHERE `id` = '$id'") or die(mysql_error());
	mysql_query("UPDATE `Donaterang` SET `Nick` = '$nick' WHERE `id` = '$id' AND `server` = '$server'") or die(mysql_error());
}

?>