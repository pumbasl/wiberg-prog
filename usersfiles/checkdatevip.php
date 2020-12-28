<?php

include('bd.php');

$id = $_GET['id'];

$result = mysql_query("SELECT * FROM `vips` WHERE `id` = '$id'") or die(mysql_error());
$myrow = mysql_fetch_array($result);

echo "" .$myrow['Date'];

?>