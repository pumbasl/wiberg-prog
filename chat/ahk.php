<?php 
$Text = $_GET['Text']; // Текст

$file = 'file.txt';

$current = file_get_contents($file);
$current .= "$Text\n";

file_put_contents($file, $current);

?>