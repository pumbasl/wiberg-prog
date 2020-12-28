<?php

include('bd.php');

$nick = $_GET['nick'];

mysql_query("DELETE FROM `support` WHERE `Nickquest` = '$nick'") or die(mysql_error());