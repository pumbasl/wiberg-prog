<?php

include('bd.php');

$result = mysql_query("SELECT * FROM `info` WHERE `newid` = '5'") or die(mysql_error());
$myrow = mysql_fetch_array($result);

echo "" .$myrow['id'];

?>