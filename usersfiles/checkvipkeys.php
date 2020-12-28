<?php

include('bd.php');

$key = $_GET['key'];

$resultat = mysql_query("SELECT * FROM `vip` WHERE `keysvip` = '$key' AND `usevip` = '0'", $db) or die(mysql_error());;
$mysq = mysql_fetch_array($resultat);

if (empty($mysq[1])) {
	echo "False";
}
else {
	echo "True";
}

?>