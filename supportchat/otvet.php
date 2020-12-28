<?php

include('bd.php');

$nick = $_GET['nick'];
$nickid = $_GET['nickid'];
$text = $_GET['text'];

mysql_set_charset("utf8");
mysql_query("UPDATE `support` SET `Supported` = '$nick', `Answer` = '$text' WHERE `Nickquest` = '$nickid'") or die(mysql_error());