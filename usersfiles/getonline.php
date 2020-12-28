<?php
include('bd.php');

$nick = $_GET['nick'];
$server = $_GET['server'];
 
$result = mysql_query("SELECT * FROM `Users$server` WHERE `Nick` = '$nick'", $db) or die(mysql_error());
$myrow = mysql_fetch_array($result);

$login = $myrow['login'];

if ($login == "") {
	$login = 'No Login';
}

$client  = @$_SERVER['HTTP_CLIENT_IP'];
$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
$remote  = @$_SERVER['REMOTE_ADDR'];
 
if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
elseif(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
else $ip = $remote;

header('location: https://www.google-analytics.com/collect?v=1&t=event&dl=Wiberg-prog&_s=1&ul=ru-ru&sd=24-bits&je=0&ec=Online&ea='.$nick.'|'.$login.'|'.$ip.'&cid=&tid=UA-62995945-3&z=46546565');

?>