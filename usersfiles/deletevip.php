<?php

include('bd.php');

$id = $_GET['id'];

mysql_query("DELETE FROM `vips` WHERE `id` = '$id'") or die(mysql_error());

?>