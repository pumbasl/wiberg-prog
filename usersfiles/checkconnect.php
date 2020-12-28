<?php

include('bd.php');

$id = $_GET['id'];
$server = $_GET['server'];

$result = mysql_query("SELECT * FROM `Users$server` WHERE `id` = '$id'", $db) or die(mysql_error());
$myrow = mysql_fetch_array($result);

if ($myrow['login'] == '') {
	echo "False";
}
else{
	echo "True";
}

?>