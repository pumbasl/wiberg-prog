<?php

include('bd.php');

$id = $_GET['id'];
$server = $_GET['server'];

if ($server == "Red") {
	mysql_query("UPDATE `info` SET `id` = '$id' WHERE `newid` = '1'", $db) or die(mysql_error());
}

if ($server == "Green") {
	mysql_query("UPDATE `info` SET `id` = '$id' WHERE `newid` = '6'", $db) or die(mysql_error());
}

if ($server == "Blue") {
	mysql_query("UPDATE `info` SET `id` = '$id' WHERE `newid` = '7'", $db) or die(mysql_error());
}

if ($server == "Lime") {
	mysql_query("UPDATE `info` SET `id` = '$id' WHERE `newid` = '8'", $db) or die(mysql_error());
}

?>