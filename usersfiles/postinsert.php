<?php

include('bd.php');

$Nick = $_GET['Nick'];
$Time = $_GET['Time'];
$Date = date("d.m.Y");

$result = mysql_query("INSERT INTO `post` (`Nick`, `Time`, `Date`) VALUES ('$Nick', '$Time', '$Date')") or die(mysql_error());


?>