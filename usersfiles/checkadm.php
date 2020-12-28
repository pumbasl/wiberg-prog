<?php

include('bd.php');

$nick = $_GET['nick'];

$result = mysql_query("SELECT * FROM `players` WHERE `Nick` = '$nick'") or die(mysql_error());
$myrow = mysql_fetch_array($result);

if(empty($myrow['Nick'])){
	echo "False";
}
else{
	echo "True";
}

?>