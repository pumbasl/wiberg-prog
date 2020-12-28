<?php
	session_start(); 
	include ("bd.php");  
	if (empty($_SESSION['login'])) 
	{ 
		$_SESSION['link'] = '';
		header('location: /lk/login.php');
	} 
	else 
	{ 
		require('inc/headerlogins.inc');
		$login = $_SESSION['login'];
		$result = mysql_query("SELECT * FROM `UsersLK` WHERE `login` = '$login'", $db) or die(mysql_error());
		$myrowlk = mysql_fetch_array($result);
		$server = $myrowlk['server'];
		if ($myrowlk['nickname_account'] != '') {
			$result = mysql_query("SELECT * FROM `Users$server` WHERE `login` = '$login'", $db) or die(mysql_error());
			$myrow = mysql_fetch_array($result);
		}
		$Nickplayer = $myrowlk['nickname_account'];
		if($Nickplayer == '')
		{
			$Nickplayer = 'No Name';
		}
		if (isset($_POST['submit_button'])) {
			$_SESSION['emailuser'] = $_POST['emailuser'];
			$_SESSION['emailcod'] = time();
			$_SESSION['email_page'] = 'index.php';
			$_SESSION['subject'] = 'Подтверждение почты.';
			$_SESSION['body'] = 'Ваш код: '.$_SESSION['emailcod'];
			header('location: mail.php');
		}
		if (isset($_POST['submit_buttonconfirimkod'])) {
			if ($_POST['emailkodconfirim'] == $_SESSION['emailcod']) {
				$emailcodend = $_SESSION['emailuser'];
				mysql_query("UPDATE `UsersLK` SET `email` = '$emailcodend' WHERE `login` = '$login'", $db) or die(mysql_error());
				unset($_SESSION['emailcod']);
				header('location: /lk/');
			}
		}
		if ($myrow['status'] == 1) {
			$myrow['status'] = 'Новичок';
			$timestatus = '<span style="color: #2E8B57">Навсегда</span>';
		}
		if ($myrow['status'] == 2) {
			$myrow['status'] = 'Пользователь';
			$timestatus = '<span style="color: #2E8B57">Навсегда</span>';
		}
		if ($myrow['status'] == 3) {
			$myrow['status'] = 'Опытный пользователь';
			$timestatus = '<span style="color: #2E8B57">Навсегда</span>';
		}
		if ($myrow['status'] == 4) {
			$myrow['status'] = 'Лидер';
			$timestatus = '<span style="color: #2E8B57">Навсегда</span>';
		}
		if ($myrow['status'] == 5) {
			$result = mysql_query("SELECT * FROM `vips` WHERE `Nick` = '$Nickplayer'", $db) or die(mysql_error());
			$myrowvips = mysql_fetch_array($result);
			$myrow['status'] = '<span style="color: #FF0000">Премиум</span>';
			$timestatus = 'До <span style="color: #2E8B57">'.$myrowvips['Date'].'</span>';
		}
		if ($myrow['status'] == 6) {
			$myrow['status'] = '<span style="color: #FF0000">Администратор проекта</span>';
			$timestatus = '<span style="color: #2E8B57">Навсегда</span>';
		}
		if ($server == 'Red') {
			$servertag = '<span style="color: #FF0000">Red</span>';
		}
		if ($server == 'Green') {
			$servertag = '<span style="color: #008000">Green</span>';
		}
		if ($server == 'Blue') {
			$servertag = '<span style="color: #0000FF">Blue</span>';
		}
		if ($server == 'Lime') {
			$servertag = '<span style="color: #00FF00">Lime</span>';
		}
	}
?> 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf8">
	<title>Личный кабинет | AHK by Wiberg</title>
	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/test.css">
	<link rel="stylesheet" type="text/css" href="css/ind.css">
</head>
<body>
	<div id="header">
		<a href="/lk"><img src="img/logo.png" class="logo"></a>
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
	<div id="sidebar">
		<ul>
			<li><a href="/">Главная</a></li>
			<li><a href="/lk" class="selected">Личный кабинет</a></li>
			<li><a href="donate.php">Купить донат очки</a></li>
			<li><a href="help.php">Установка</a></li>
			<li><a href="garb.php">Наряды</a></li>
			<li><a href="download.php">Скачивание</a></li>
			<li><a href="news.php">Новости AHK</a></li>
			<li><a href="owners.php">Создатели</a></li>
			<li><a href="support.php">Контакты</a></li>
			<?php if (empty($_SESSION['login'])) {
				echo "<li><a href='login.php'>Авторизоваться</a></li>";
				echo "<li><a href='reg.php'>Регистрация</a></li>";
			}else{
				echo "<li><a href='logout.php'>Выйти</a></li>";
			} ?>
		</ul>

	</div>
	<div id="containerid">
		<H1>Личный кабинет</H1>
		<?php if ($myrowlk['nickname_account'] == '') {
			echo "<img class='rotate imgstats' src='img/globalimglk.jpg'>";
		} else { echo "<img class='rotate imgstats' src='https://files.advance-rp.ru/media/skins/" .$myrow['Skin']. ".png'>"; } ?>
	</div>
	<div id="containerlogin"><span class="infostats"><?php echo "@" .$myrowlk['login']; ?><br><?php echo "" .$Nickplayer; ?></span></div>
	<div id="containeraccount">
		<table class="statslk">
		<thead>
		<tr>
		<th>Информации об акаунте:</th>
		<th></th>
		</tr>
		</thead>
		<tbody>
		<tr>
		<td>Игровой никнейм:</td><td><?php echo "" .$Nickplayer; ?></td></tr>
		<tr>
		<td>Логин от ЛК:</td><td><?php echo "" .$myrowlk['login']; ?></td></tr>
		<tr>
		<td>Почта:</td><td><?php if (empty($myrowlk['email']) and empty($_SESSION['emailcod']) and $server != '') {
			echo "<div id='emailconfirim'><a href='#'>Введите и подтвердите почту.</a></div>";
			if (empty($_SESSION['emailcod'])) {
				echo "<form method='POST' action='index.php'><div id='emailconfiriminput'><input type='email' name='emailuser' placeholder='Введите адрес почты'><br><button type='submit' name='submit_button'>Отправить</button></div></form>";
			}}; 
			if (isset($_SESSION['emailcod']) and empty($myrowlk['email'])) {
			 	echo "<form method='POST' action='index.php'><input type='text' name='emailkodconfirim' placeholder='Введите отправленный код'><br><button type='submit' name='submit_buttonconfirimkod'>Отправить</button></form>";
			 }
			 else{
			 	if ($server == '') {
			 		echo "Нет привязанного акаунта";
			 	}
			 	else {
		 			echo "<a href='#'>".$myrowlk['email']."</a>";
			 	}
			 } ?></td></tr>
		<tr>
			<tr>
		<td>Cтатус:</td><td><?php echo "" .$myrow['status']; ?></td></tr>
		<td>Сервер:</td><td><?php if ($server=='') {
			echo "Нет привязанного акаунта";
		} else { echo "" .$servertag; } ?></td></tr>
		<tr>
		<td>Действует до:</td><td><?php echo "" .$timestatus; ?></td></tr>
		<tr>
		<td>Последния авторизация в игре:</td><td><?php echo "" .$myrow['Lastlogin']; ?></td></tr>
		</tbody>
		</tr>
		</table>
	</div>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-62995945-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-62995945-3');
</script>

<!-- <script type="text/javascript" src="admin/js/opendiv.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/jquery.js"></script>
<script>
$('.nav-toggle').on('click', function(){
  $('#sidebar').toggleClass('active');
});
</script>
<script>
$('#emailconfirim').on('click', function(){
  $('#emailconfirim').toggleClass('click');
  $('#emailconfiriminput').toggleClass('click');
});
</script>
<script>
</script>


<script type="text/javascript" src="https://vk.com/js/api/openapi.js?154"></script>

<!-- VK Widget -->
<div id="vk_community_messages"></div>
<script type="text/javascript">
VK.Widgets.CommunityMessages("vk_community_messages", 159176195, {tooltipButtonText: "Есть вопросы/предложения?"});
</script>

</body>
</html>