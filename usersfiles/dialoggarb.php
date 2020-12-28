<?php

include('bd.php');

mysql_set_charset("utf8");

$resultat = mysql_query("SELECT COUNT(1) FROM `garb`", $db) or die(mysql_error());;
$mysq = mysql_fetch_array($resultat);
$id = $mysq['0'];

for ($i=0; $i <= $id; $i++) { 
	$result = mysql_query("SELECT * FROM `garb` WHERE `Make` = 0 AND `newid` = '$i'") or die(mysql_error());
	$myrow = mysql_fetch_array($result);
	if (!empty($myrow))
	{
		echo "" .$myrow['newid']."|".$myrow['Nick']."|".$myrow['Nickgive']."|".$myrow['amount']."|".$myrow['Reason']."|".$myrow['Date']."|".$myrow['Time']." ";
	}
}

?>