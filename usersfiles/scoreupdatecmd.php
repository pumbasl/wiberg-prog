<?php

include('bd.php');

$nick = $_GET['nick'];

$result = mysql_query("SELECT * FROM `scoreupdate` WHERE `Nick` = '$nick'") or die(mysql_error());
$myrow = mysql_fetch_array($result);

if ($myrow['used'] == '1') {
	exit('False');
}

if (empty($myrow['score'])) {
	exit('False');
}

echo "" .$myrow['score'];

mysql_query("UPDATE `scoreupdate` SET `used` = 1 WHERE `Nick` = '$nick'") or die(mysql_error());

?>