<?php

include('bd.php');

mysql_set_charset("utf8");
$result = mysql_query("SELECT * FROM `konk` WHERE `usevip` = '0'") or die(mysql_error());
$myrow = mysql_fetch_array($result);

if (empty($myrow['keysvip'])) {
	echo "False";
}
else{
	echo "" .$myrow['keysvip'];
}

mysql_query("UPDATE `konk` SET `usevip` = '1' WHERE `usevip` = '0'") or die(mysql_error());

?>