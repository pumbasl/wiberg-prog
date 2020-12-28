<?php
header('Content-Type: text/html; charset=utf-8');
$tmp=file('file.txt'); 
$newtmp=array_reverse($tmp); 

foreach ($newtmp as $value) 
{ 
	echo $value; 
} 
?> 