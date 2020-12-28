<?php

include('bd.php');

$id = $_GET['id'];

$result = mysql_query("SELECT * FROM `Owners` WHERE `id` = '$id'") or die(mysql_error());
$myrow = mysql_fetch_array($result);

if(empty($myrow['Nick'])){
	echo "False|0";
}
else{
	echo "True|" .$myrow['lvl'];
}

?>