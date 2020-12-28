<?php

include('bd.php');

$text = $_GET['text'];
$nick = $_GET['nick'];

mysql_set_charset("utf8");
mysql_query("INSERT INTO `support` (`Nickquest`, `Question`) VALUES ('$nick', '$text')") or die(mysql_error());

?>