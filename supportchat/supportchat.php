<?php

include('bd.php');

$questnick = $_GET['questnick'];

mysql_set_charset("cp1251");
$result = mysql_query("SELECT * FROM `support` WHERE `Nickquest` = '$questnick'") or die(mysql_error());
$myrow = mysql_fetch_array($result);

if (empty($myrow['Supported'])) {
	echo "";	
}
else{
	echo "#" .$myrow['Supported']. "|" .$myrow['Answer'];
}

?>