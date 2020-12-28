<?php

include('bd.php');

$id = $_GET['id'];
$server = $_GET['server'];

$result = mysql_query("SELECT * FROM `voting` WHERE `id` = '$id'", $db) or die(mysql_error());
$myrow = mysql_fetch_array($result);
$result = mysql_query("SELECT * FROM `info` WHERE `newid` = '9'", $db) or die(mysql_error());
$myrowinfo = mysql_fetch_array($result);

if ($myrowinfo['id'] == 0) {
	echo "False|1";
	die();
}

if ($myrow['nick'] == '') {
	echo "True";
}
else{
	echo "False|2";
}

?>