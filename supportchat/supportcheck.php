<?php

include('bd.php');

mysql_set_charset("cp1251");
$result = mysql_query("SELECT * FROM `support` WHERE `Supported` = ''") or die(mysql_error());
$myrow = mysql_fetch_array($result);

echo "#" .$myrow['Nickquest']. "|" .$myrow['Question'];

?>