<?php

mysql_set_charset("utf8");
$idusers = 0;
$resultat = mysql_query("SELECT COUNT(1) FROM `UsersRed`", $db) or die(mysql_error());
$mysq = mysql_fetch_array($resultat);
$idusers += $mysq['0'];
$resultat = mysql_query("SELECT COUNT(1) FROM `UsersGreen`", $db) or die(mysql_error());
$mysq = mysql_fetch_array($resultat);
$idusers += $mysq['0'];
$resultat = mysql_query("SELECT COUNT(1) FROM `UsersBlue`", $db) or die(mysql_error());
$mysq = mysql_fetch_array($resultat);
$idusers += $mysq['0'];
$resultat = mysql_query("SELECT COUNT(1) FROM `UsersLime`", $db) or die(mysql_error());
$mysq = mysql_fetch_array($resultat);
$idusers += $mysq['0'];
/*$resultattwo = mysql_query("SELECT COUNT(1) FROM `Users`", $db) or die(mysql_error());;
$mysqtwo = mysql_fetch_array($resultattwo);
$idtwo = $mysqtwo['0'];
$id += $idtwo;*/
$date = date("d.m.Y");
$daterestlt = mysql_query("SELECT COUNT(1) FROM `Logs` WHERE `Date` = '$date' AND `comment` = 'Запустил и авторизовался в скрипте.'", $db) or die(mysql_error());
$myrowtime = mysql_fetch_array($daterestlt);

?>