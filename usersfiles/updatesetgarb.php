<?php

include('bd.php');

$id = $_GET['id'];

mysql_query("UPDATE `garb` SET `Make` = 1 WHERE `newid` = '$id'") or die(mysql_error());

?>