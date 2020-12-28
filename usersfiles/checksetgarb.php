<?php

include('bd.php');

$id = $_GET['id'];

$result = mysql_query("SELECT * FROM `garb` WHERE `newid` = '$id'") or die(mysql_error());
$myrow = mysql_fetch_array($result);

if(empty($myrow['Nick'])){
	echo "False";
}
else{
	echo "" .$myrow['Nick']. "#" .$myrow['Make'];
}

?>