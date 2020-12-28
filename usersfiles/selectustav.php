<?php

include('bd.php');

$id = $_GET['id'];

mysql_set_charset("cp1251");
$result = mysql_query("SELECT * FROM `ustavred` WHERE `id` = '$id'") or die(mysql_error());
$myrow = mysql_fetch_array($result);

echo "" .$myrow['Text'];

?>