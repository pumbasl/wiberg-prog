<?php

include('bd.php');

$id = $_GET['id'];
$text = $_GET['text'];
$nick = $_GET['nick'];
$server = $_GET['server'];

mysql_set_charset("utf8");

$result = mysql_query("SELECT * FROM `Donaterang` Where `id` = '$id' AND `server` = '$server'") or die(mysql_error());
$myrow = mysql_fetch_array($result);

if (empty($myrow['id'])) {
	mysql_query("INSERT INTO `Donaterang` (`id`, `Nick`, `Namerang`, `server`) VALUES ('$id', '$nick', '$text', '$server')") or die(mysql_error());
}
else {
	mysql_query("UPDATE `Donaterang` SET `Namerang` = '$text', `Moderation` = '0' WHERE `id` = '$id' AND `server` = '$server'") or die(mysql_error());
}

?>