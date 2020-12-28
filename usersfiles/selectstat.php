<?php

include('bd.php');

$Nick = $_GET['nick'];
$server = $_GET['server'];

mysql_set_charset("utf8");
$result = mysql_query("SELECT * FROM `players` WHERE `Nick` = '$Nick' AND `server` = '$server'") or die(mysql_error());
$myrow = mysql_fetch_array($result);

if ($myrow['lastupdate'] == '') {
	$myrow['lastupdate'] = 'null';
}

echo "" .$myrow['newid']."|".$myrow['Nick']."|".$myrow['lvl']."|".$myrow['Phone']."|".$myrow['Sex']."|".$myrow['Frak']."|".$myrow['Unit']."|".$myrow['Rangname']."|".$myrow['Home']."|".$myrow['lastupdate'];

?>