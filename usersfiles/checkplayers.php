<?php

include('bd.php');

$nick = $_GET['nick'];
$server = $_GET['server'];

$result = mysql_query("SELECT * FROM `players` WHERE `Nick` = '$nick' AND `server` = '$server'") or die(mysql_error());
$myrow = mysql_fetch_array($result);

if(empty($myrow['Nick'])){
	echo "False";
}
else{
	echo "True";
}

?>