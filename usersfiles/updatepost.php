<?php

include('bd.php');

$Nick = $_GET['Nick'];
$post = $_GET['post'];
$date = $_GET['date'];

mysql_query("UPDATE `post` SET `Time` = '$post' WHERE `Nick` = '$Nick' AND `Date` = '$date'") or die(mysql_error());

?>