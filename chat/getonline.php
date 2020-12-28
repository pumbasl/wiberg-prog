<?php 
header('Content-Type: text/html; charset=utf-8');
$Text = $_GET['Text']; // Текст

$file = 'online.txt';

$current = file_get_contents($file);
$current .= "$Text\n";

file_put_contents($file, $current);

?>