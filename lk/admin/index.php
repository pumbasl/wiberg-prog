<?php  

session_start(); 
include ("bd.php");  
if (empty($_SESSION['login'])) 
{ 
// Если пусты, то мы не выводим ссылку 
$_SESSION['link'] = 'admin/';
header('location: /lk/login.php');
}
else{
	require($_SERVER['DOCUMENT_ROOT']."/lk/inc/headerlogins.inc");
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
	if ($myrow['status'] == '6') {
		$blacklistperm = $_SERVER['DOCUMENT_ROOT']."/lk/leaders/blacklistahk.txt";
	}
	else{
		header('HTTP/1.0 404 Not Found');
		die;
	}
}

if (isset($_POST['submit_donate'])) {
	if (!empty($_POST['donatenick']) or !empty($_POST['amountdonate'])) {
		$donatenick = $_POST['donatenick'];
		$donateamount = $_POST['amountdonate'];
		$date = date("Y.m.d");
		mysql_query("INSERT INTO `donategive`(`Nick`, `donate`, `date`) VALUES ('$donatenick', '$donateamount', '$date')", $db) or die(mysql_error());
		$notification = '<span class="successcomplete">Вы успешно выдали донат.</span>';
	}
	else{
		$notification = '<span class="errorcomplete">Вы не заполнили одно из полей.</span>';
	}
}

if (isset($_POST['submit_score'])) {
	if (!empty($_POST['scorenick']) or !empty($_POST['amountscore'])) {
		$scorenick = $_POST['scorenick'];
		$amountscore = $_POST['amountscore'];
		mysql_query("INSERT INTO `scoreupdate`(`Nick`, `score`) VALUES ('$scorenick', '$amountscore')", $db) or die(mysql_error());
		$notification = '<span class="successcomplete">Вы успешно выдали очки.</span>';
	}
	else{
		$notification = '<span class="errorcomplete">Вы не заполнили одно из полей.</span>';
	}
}

if (isset($_POST['sumbit_finduser'])) {
	if (!empty($_POST['nick'])) {
		$nick = $_POST['nick'];
		$inforesult = mysql_query("SELECT * FROM `players` WHERE `Nick` = '$nick'", $db) or die(mysql_error());
		$inforesult = mysql_fetch_array($inforesult);
		$infoopen = '1';
		$notification = '<span class="successcomplete">Пользователь найден</span>';
	}
	else{
		$notification = '<span class="errorcomplete">Вы не заполнили поле.</span>';
	}
}

if (isset($_POST['submit_blacklist'])) {
	if (!empty($_POST['blacklist'])) {
		file_put_contents($blacklistperm, $_POST['blacklist']);
	}
	else{
		$notification = '<span class="errorcomplete">Вы не заполнили поле.</span>';
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Админ панель | AHK by Wiberg</title>
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
			<li><a href="#">Запусков за сегодня: <?php echo "" .$myrowtime['0']; ?></a></li>
			<li><a href="#">Всего пользователей: <?php echo "" .$idusers; ?></a></li>
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
			<li><a href="owners.php">Создатели</a></li>
			<li><a href="support.php">Контакты</a></li>
			<?php if (empty($_SESSION['login'])) {
				echo "<li><a href='login.php'>Авторизоваться</a></li>";
				echo "<li><a href='reg.php'>Регистрация</a></li>";
			}else{
				echo "<li><a href='/lk/logout.php'>Выйти</a></li>";
			} ?>
		</ul>
		<div id="sidebar-btn">
			<span></span>
			<span></span>
			<span></span>
		</div>

	</div>
	<div id="supportcontent">
		<h4>Доброе утро администратор <?php echo "<span class='textadminname'>" .$myrow['Nick']. "</span></h4>"; ?>
			<br class="maintextadmin">Ваш спектр действий:<br><br>
			<?php if (!empty($notification)) {
				echo "" .$notification."<br><br>";
				unset($notification);
			} ?>

			<a href="#" onclick="openbox('findusernick'); return false"><button class="btn btn-success waves-effect waves-light indexbutton">Найти пользователя по нику</button></a><br><br>
			<div id="findusernick" <?php if($infoopen == 1){ echo 'style="display: inline;"'; } else { echo 'style="display: none;"'; } ?>>
				<form method="POST" action="index.php">
			<p>Введите Nick игрока: <input type="text" name="nick"></p>
			<p><button type="submit" name="sumbit_finduser" class="btn btn-success waves-effect waves-light tabledonatebutton">Найти</button></p>
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
		} ?><br>
			</div>

			<a href="#" onclick="openbox('givescore'); return false"><button class="btn btn-success waves-effect waves-light indexbutton">Выдать очки</button></a><br><br>
			<div id="givescore" style="display: none;">
				<form action="index.php" method="POST">
					Ник игрока: <input type="text" name="scorenick"><br>
					Количество: <input type="text" name="amountscore"><br>
					<br><button type="submit" name="submit_score" class="btn btn-success waves-effect waves-light savebuttondonate">Выдать</button>
				</form><br><br>
			</div>

			<a href="#" onclick="openbox('blacklist'); return false"><button class="btn btn-success waves-effect waves-light indexbutton">Черный список МО</button></a><br><br>
			<div id="blacklist" style="display: none;">
				<form action="index.php" method="POST">
					<textarea cols="40px" rows="30px" name="blacklist" placeholder="Черный список МО" style="resize: none;"><?php echo file_get_contents($blacklistperm) ?></textarea>
					<br><button type="submit" name="submit_blacklist" class="btn btn-success waves-effect waves-light savebuttondonate">Сохранить</button>
				</form><br><br>
			</div>

			<a href="#" onclick="openbox('givedonate'); return false"><button class="btn btn-success waves-effect waves-light indexbutton">Выдать донат</button></a><br><br>
			<div id="givedonate" style="display: none;">
				<form action="index.php" method="POST">
					Ник игрока: <input type="text" name="donatenick"><br>
					Количество: <input type="text" name="amountdonate"><br>
					<br><button type="submit" name="submit_donate" class="btn btn-success waves-effect waves-light savebuttondonate">Выдать</button>
					<a href="#" onclick="openbox('selecttabledonate'); return false"><button class="btn btn-success waves-effect waves-light tabledonatebutton">Таблица донатов</button></a><br><br>
					<div id="selecttabledonate" style="display: none;"><br>
						<table class="donatetable">
						<thead>
						<tr>
						<th>Ник</th>
						<th>Количество</th>
						<th>Статус</th>
						<th>Дата</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$rescicle = mysql_query("SELECT COUNT(1) FROM `donategive`", $db) or die(mysql_error());
						$mysqlcuql = mysql_fetch_array($rescicle);
						$dd = $mysqlcuql['0'];
						for ($i=1; $i <= $dd; $i++) { 
							$donateinfo = mysql_query("SELECT * FROM `donategive` WHERE `newid` = '$i'", $db) or die(mysql_error());
							$donateinfo = mysql_fetch_array($donateinfo);
							if ($donateinfo['used'] == '1') {
								$donateinfo['used'] = 'Получен';
							}
							else{
								$donateinfo['used'] = 'Не полуен.';
							}
							echo "<tr><td>".$donateinfo['Nick']."</td><td>".$donateinfo['donate']."</td><td>".$donateinfo['used']."</td><td>".$donateinfo['date']."</td></tr>";
						}
						?>
						</tbody>
						</table>
					</div>
				</form>
			</div>
	</div>
<script type="text/javascript" src="js/opendiv.js"></script>
<script type="text/javascript" src="js/waves.js"></script>
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