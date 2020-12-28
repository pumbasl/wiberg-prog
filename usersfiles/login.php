<?php

include('bd.php');

$Nick = $_GET['Nick'];
$Date = date("d.m.Y");

$result = mysql_query("SELECT * FROM `post` WHERE `Nick` = '$Nick' AND `Date` = '$Date'") or die(mysql_error());
$myrow = mysql_fetch_array($result);

echo "" .$myrow['Time'];

?>