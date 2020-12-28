<?php

include('bd.php');

$id = $_GET['id'];

$result = mysql_query("SELECT * FROM `bans` WHERE `id` = '$id'") or die(mysql_error());
$myrow = mysql_fetch_array($result);

if (empty($myrow['id'])){
	echo "False";
}
else{
	echo "True";
}



?>