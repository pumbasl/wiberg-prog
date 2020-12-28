<?php  

session_start(); 
include ("bd.php");  
require('inc/headerlogins.inc');
$login = $_SESSION['login'];
$result = mysql_query("SELECT * FROM `UsersLK` WHERE `login` = '$login'", $db) or die(mysql_error());
$myrowlk = mysql_fetch_array($result);
$server = $myrowlk['server'];
if ($myrowlk['nickname_account'] != '') {
	$result = mysql_query("SELECT * FROM `Users$server` WHERE `login` = '$login'", $db) or die(mysql_error());
	$myrow = mysql_fetch_array($result);
}
if ($myrowlk['nickname_account'] == '') {
		header('location: /lk/connectaccount.php');
}
$Nickplayer = $myrowlk['nickname_account'];

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Загрузить рингтон | AHK by Wiberg</title>
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
			<li><a href="donate.php">Купить донат очки</a></li>
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
	<div id="contetring">
		<img src="img/music.png" width="80px">
		<h2><span class="Text">Загрузить мелодию на звонок</span></h2>
		<form method="post" enctype="multipart/form-data" action="musiccall.php">
		<p><span class="Text"><input name="file" size="18" type="file" multiple accept="audio/*" value=""></span></p>
		<p><input name="submit" type="submit" value="Загрузить"></p>
		</form><br>
		<span class="Text">Прослушать свой трек на <b>ЗВОНОК</b></span><br>
		<audio controls class="audio">
			<source src="music/<?php echo "" .$Nickplayer."@".$server; ?>.mp3" type="audio/mpeg">
		</audio>
		<h2><span class="Text">Загрузить мелодию на СМС</span></h2>
		<form method="post" enctype="multipart/form-data" action="musicsms.php">
		<p><span class="Text"><input name="file" size="18" type="file" multiple accept="audio/*" value=""></span></p>
		<p><input name="submit" type="submit" value="Загрузить"></p>
		</form><br>
		<span class="Text">Прослушать свой трек на <b>СМС</b></span><br>
		<audio controls class="audio">
			<source src="music/<?php echo "" .$Nickplayer."@".$server; ?>-sms.mp3" type="audio/mpeg">
		</audio><br>
		<footer>Wiberg-prog ©2017-2020</footer>
	</div>
	<script src="js/jquery.js"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-62995945-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-62995945-3');
</script>
	
<script>
	
$(document).ready(function() {
	$('#sidebar-btn').click(function() {
		$('#sidebar').toggleClass('visible');
	})
})
</script>

<script type="text/javascript" src="https://vk.com/js/api/openapi.js?154"></script>

<!-- VK Widget -->
<div id="vk_community_messages"></div>
<script type="text/javascript">
VK.Widgets.CommunityMessages("vk_community_messages", 159176195, {tooltipButtonText: "Есть вопросы/предложения?"});
</script>

</body>
</html>