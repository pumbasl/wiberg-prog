<?php 
include("bd.php");
$password = $_GET['password']; // Òåêñò
$id = $_GET['id']; // Òåêñ
$server = $_GET['server'];
$nick = $_GET['nick'];
$login = $_GET['login'];
$date = date("d.m.Y");

$result = mysql_query("SELECT * FROM `UsersLK` WHERE `login`='$login'",$db) or die(mysql_error());
$myrow = mysql_fetch_array($result);
$result = mysql_query("SELECT * FROM `Users$server` WHERE `Nick`='$nick'",$db) or die(mysql_error());
$myrowusers = mysql_fetch_array($result);


if (!empty($myrow['login']) and $myrow['login'] == $login and password_verify($password, $myrow['password']) and $myrowusers['login'] == '') {
	mysql_query("UPDATE `UsersLK` SET `account` = '$id', `nickname_account` = '$nick', `server` = '$server', `regdate` = '$date' WHERE `login` = '$login'",$db) or die(mysql_error());
	mysql_query("UPDATE `Users$server` SET `login` = '$login' WHERE `id` = '$id'",$db) or die(mysql_error());
	echo "True";
}
else{
	echo "False";
}

?>