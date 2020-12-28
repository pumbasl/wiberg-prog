<?php

include('bd.php');

$id = $_GET['id'];
$line = $_GET['line'];
$nick = $_GET['nick'];
$server = $_GET['server'];
$time = date("H:i:s");
$date = date("d.m.Y");

mysql_query("INSERT INTO `voting` (`nick`, `vote`, `server`, `id`, `time`, `date`) VALUES ('$nick', '$line', '$server', '$id', '$time', '$date')") or die(mysql_error());
?>