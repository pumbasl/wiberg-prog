<?php

include('bd.php');

$nick = $_GET['nick'];

$result = mysql_query("SELECT * FROM `donategive` WHERE `Nick` = '$nick'") or die(mysql_error());
$myrow = mysql_fetch_array($result);

if ($myrow['used'] == '1') {
	exit('False');
}

if (empty($myrow['donate'])) {
	exit('False');
}

echo "" .$myrow['donate'];

mysql_query("UPDATE `donategive` SET `used` = 1 WHERE `Nick` = '$nick'") or die(mysql_error());

?>