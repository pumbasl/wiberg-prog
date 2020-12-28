<?php 
$tmp=file('file.txt'); 
$newtmp=array_reverse($tmp); 

foreach ($newtmp as $value) 
{ 
echo $value; 
} 
?> 