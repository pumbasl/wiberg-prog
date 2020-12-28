<?php
$tmp=file('online.txt'); 
$newtmp=array_reverse($tmp); 

foreach ($newtmp as $value) 
{ 
echo $value; 
} 
?> 