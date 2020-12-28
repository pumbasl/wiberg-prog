<?php 
include ("bd.php"); 
$merchant_id = 2390; // id вашего магазина
$secret_word2 = '1i5iQq58lWp_6r3hvjU_1hMIZSPKAq3M'; // секретный ключ 2

$sign = md5($merchant_id.':'.$_REQUEST['amount'].':'.$secret_word2.':'.$_REQUEST['merchant_id']);

if ($sign != $_REQUEST['sign_2']) {
    die('Not found 404');
}

$date = date("Y.m.d");
$time = date("H:i:s");

$custom_field = $_REQUEST['custom_field'];
$amount = $_REQUEST['amount'];
$amountall = $_REQUEST['amount'];
$intid = $_REQUEST['intid'];

$result = mysql_query("SELECT * FROM `UsersLK` WHERE `login` = '$custom_field'", $db) or die(mysql_error());
$myrowlk = mysql_fetch_array($result);

$server = $myrowlk['server'];
$Nickplayer = $myrowlk['nickname_account'];

$result = mysql_query("SELECT * FROM `Users$server` WHERE `login` = '$custom_field'", $db) or die(mysql_error());
$myrow = mysql_fetch_array($result);
$amountall += $myrow['donate'];

mysql_query("INSERT INTO `donategive`(`Nick`, `donate`, `used`, `date`) VALUES ('$Nickplayer', '$amount', '1', '$date')", $db) or die(mysql_error());
mysql_query("INSERT INTO `payments`(`ID payments`, `Nick`, `Amount`, `server`, `Date`, `Time`) VALUES ('$intid', '$Nickplayer', '$amount', '$server', '$date', '$time')", $db) or die(mysql_error());
mysql_query("UPDATE `Users$server` SET `donate` = '$amountall' WHERE `login` = '$custom_field'", $db) or die(mysql_error());

 ?>