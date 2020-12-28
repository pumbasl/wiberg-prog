<?php
session_start(); 
include ("bd.php"); 
if (empty($_SESSION['login'])) 
{ 
	$_SESSION['link'] = 'donate.php';
	header('location: /lk/login.php');
}
else{
	require('inc/headerlogins.inc');
	mysql_set_charset("utf8");
	$login = $_SESSION['login'];
	$result = mysql_query("SELECT * FROM `UsersLK` WHERE `login` = '$login'", $db) or die(mysql_error());
	$myrowlk = mysql_fetch_array($result);
	$server = $myrowlk['server'];
	$Nickplayer = $myrowlk['nickname_account'];
	$result = mysql_query("SELECT * FROM `Users$server` WHERE `login` = '$login'", $db) or die(mysql_error());
	$myrow = mysql_fetch_array($result);
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Подключение | AHK by Wiberg</title>
	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/test.css">
	<link rel="stylesheet" type="text/css" href="css/ind.css">
</head>
<body>

<div id="header">
		<a href="/lk"><img src="img/logo.png" height="45px" class="logo"></a>
		<ul>
			<li><a href="ring.php">Загрузить рингтон</a></li>
			<li><a href="#">Ваш баланс: <?php if ($myrowlk['nickname_account'] == '') {
				echo "нет акаунта";
			} else { echo "" .$myrow['donate']." донат очков"; } ?></a></li>
			<li><a href="#">Запусков за сегодня: <?php echo "" .$myrowtime['0']; ?></a></li>
			<li><a href="#">Всего пользователей: <?php echo "" .$idusers; ?></a></li>
			<li><div class="nav-toggle"><span></span></div></li>
		</ul>
	</div>
	<div id="sidebar" class="visible">
		
		<ul>
			<li><a href="/">Главная</a></li>
			<li><a href="/lk">Личный кабинет</a></li>
			<li><a href="donate.php" class="selected">Купить донат очки</a></li>
			<li><a href="help.php">Установка</a></li>
			<li><a href="garb.php">Наряды</a></li>
			<li><a href="download.php">Скачивание</a></li>
			<li><a href="news.php">Новости AHK</a></li>
			<li><a href="post.php">Время с постов</a></li>
			<li><a href="owners.php">Создатели</a></li>
			<li><a href="support.php">Контакты</a></li>
			<?php if (empty($_SESSION['login'])) {
				echo "<li><a href='login.php'>Авторизоваться</a></li>";
				echo "<li><a href='reg.php'>Регистрация</a></li>";
			}else{
				echo "<li><a href='logout.php'>Выйти</a></li>";
			} ?>
		</ul>
		<div id="sidebar-btn">
			<span></span>
			<span></span>
			<span></span>
		</div>

	</div>
	<div id="supportcontent">
		<H4><p><b>Добро пожаловать на страницу подключения.</b></p></H4><br>
		<p>Прежде чем задонатить в ахк или посмотреть какие либо страницы, Вам нужно подключить игровой акаунт к акаунту личного кабинета.<br>
			Это можно сделать по команде <span style="color: #FF0000">/con</span> в игре.</p>
		<footer><hr>Wiberg-prog ©2017-2020</footer>
	</div>

<!-- <script type="text/javascript" src="admin/js/opendiv.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/jquery.js"></script>
<script>
$('.nav-toggle').on('click', function(){
  $('#sidebar').toggleClass('active');
});
</script>

<script type="text/javascript" src="https://vk.com/js/api/openapi.js?154"></script>

<!-- VK Widget -->
<div id="vk_community_messages"></div>
<script type="text/javascript">
VK.Widgets.CommunityMessages("vk_community_messages", 159176195, {tooltipButtonText: "Есть вопросы/предложения?"});
</script>

</body>
</html>