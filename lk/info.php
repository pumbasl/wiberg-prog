<?php
session_start(); 
include ("bd.php");  
if (empty($_SESSION['Nick'])) 
{ 
// Если пусты, то мы не выводим ссылку 
$_SESSION['link'] = 'post.php';
header('location: /lk/login.php');
}
else{
	require('inc/headerlogins.inc');
	$Nickplayer = $_SESSION['Nick'];
	$result = mysql_query("SELECT * FROM `UsersRed` WHERE `Nick` = '$Nickplayer'", $db) or die(mysql_error());
	$myrow = mysql_fetch_array($result);
}

if (isset($_POST['sumbit_button'])) {
	$nick = $_POST['nick'];
	$inforesult = mysql_query("SELECT * FROM `players` WHERE `Nick` = '$nick'", $db) or die(mysql_error());
	$inforesult = mysql_fetch_array($inforesult);
	$infoopen = '1';
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Информация | Wiberg-prog</title>
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
			<li><a href="#">Ваш баланс: <?php echo "" .$myrow['donate']; ?> донат очков</a></li>
			<li><a href="#">Запусков за сегодня: <?php echo "" .$myrowtime['0']; ?></a></li>
			<li><a href="#">Всего пользователей: <?php echo "" .$id; ?></a></li>
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
			<?php if (empty($_SESSION['Nick'])) {
				echo "<li><a href='login.php'>Авторизоваться</a></li>";
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
		<form method="POST" action="info.php">
			<p>Введите Nick игрока: <input type="text" name="nick"></p>
			<p><button type="sumbit" name="sumbit_button">Посмотреть</button></p>
		</form>
		<?php if ($infoopen == '1') {
			echo "<table class='infotable'>
			<thead>
				<tr>
				<th>Пункты</th>
				<th>Информация</th>
				</tr>
				</thead>
				<tbody>
				<tr>
				<td>Ник:</td><td>" .$inforesult['Nick']. "</td></tr>
				<tr>
				<td>LVL:</td><td>" .$inforesult['lvl']. "</td></tr>
				<tr>
				<td>Пол:</td><td>" .$inforesult['Sex']. "</td></tr>
				<tr>
				<td>Номер телефона:</td><td>" .$inforesult['Phone']. "</td></tr>
				<tr>
				<td>Организация:</td><td>" .$inforesult['Frak']. "</td></tr>
				<tr>
				<td>Подразделение:</td><td>" .$inforesult['Unit']. "</td></tr>
				<tr>
				<td>Должность:</td><td>" .$inforesult['Rangname']. "</td></tr>
				<tr>
				<td>Место жительства:</td><td>" .$inforesult['Home']. "</td></tr>
				</tbody>
				</tr>
			</table>";
			//echo "Ник игрока: " . $inforesult['Nick'] . "<br>LVL игрока: " . $inforesult['lvl'] . "<br>Номер телефона: " . $inforesult['Phone'] . "<br>Пол: " . $inforesult['Sex'] . "<br>Организация: " . $inforesult['Frak'] . "<br>Подразделение: " . $inforesult['Unit'] . "<br>Должность: " . $inforesult['Rangname'] . "<br>Место проживания: " . $inforesult['Home'];
		} ?>
	</div>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-62995945-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-62995945-3');
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/jquery.js"></script>
<script>
$(document).ready(function() {
	$('#sidebar-btn').click(function() {
		$('#sidebar').toggleClass('visible');
	})
})

</script>
</script>

<script type="text/javascript" src="https://vk.com/js/api/openapi.js?154"></script>

<!-- VK Widget -->
<div id="vk_community_messages"></div>
<script type="text/javascript">
VK.Widgets.CommunityMessages("vk_community_messages", 159176195, {tooltipButtonText: "Есть вопросы/предложения?"});
</script>

</body>
</html>