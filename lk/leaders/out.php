<?php

$nick = $_GET['nick'];

$content = file_get_contents('blacklistahk.txt');
$content = str_replace($nick, '', $content);
file_put_contents('blacklistahk.txt', $content);
?>