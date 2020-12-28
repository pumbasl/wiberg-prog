<?php

include('bd.php');

$id = $_GET['id'];
$nick = $_GET['nick'];

mysql_query("UPDATE `vips` SET `id` = '$id' WHERE `Nick` = '$nick'") or die(mysql_error());

?>