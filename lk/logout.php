<?php  

	session_start(); 
	unset($_SESSION['login']);// уничтожаем переменные в сессиях
	header('location: /');
	
?>