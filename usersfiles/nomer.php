<?php

include('bd.php');

$Nick = $_GET['Nick'];

$result = mysql_query("SELECT * FROM `UsersRed` WHERE `Nick` = '$Nick'") or die(mysql_error());
$myrow = mysql_fetch_array($result);

if (empty($myrow['Nick'])){
	echo "";
}
else{
	echo "" .$myrow['Phone'];
}



?>