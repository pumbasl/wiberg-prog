<?php

include('bd.php');

$nick = $_GET['nick'];
$nickto = $_GET['nickto'];
$comment = $_GET['comment'];
$time = date("H:i:s");
$date = date("d.m.Y");
$comment = str_replace('@', ' ', $comment);
$server = $_GET['server'];

mysql_set_charset("UTF8");

if (empty($nickto)) {
	mysql_query("INSERT INTO `Logs` (`Nick`, `comment`, `server`, `Time`, `Date`) VALUES ('$nick', '$comment', '$server', '$time', '$date')") or die(mysql_error());
} else{
	mysql_query("INSERT INTO `Logs` (`Nick`, `NickTo`, `comment`, `server`, `Time`, `Date`) VALUES ('$nick', '$nickto', '$comment', '$server', '$time', '$date')") or die(mysql_error());
}

?>