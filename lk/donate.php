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
	if ($myrowlk['nickname_account'] == '') {
		header('location: /lk/connectaccount.php');
	}
	$server = $myrowlk['server'];
	$Nickplayer = $myrowlk['nickname_account'];
	$result = mysql_query("SELECT * FROM `Users$server` WHERE `login` = '$login'", $db) or die(mysql_error());
	$myrow = mysql_fetch_array($result);
}
if (isset($_POST['submit_button'])) {
	if (empty($_POST['oa'])) {
		$adv = "Вы не указали значение.";
	}
	else {
		$MERCHANT_ID   = 2390;                 // ID магазина
		$SECRET_WORD   = 'f3Y-h4qrs4WOwiu0tU7qr8KBCUy1YJEu';   // Секретный ключ
		$PAYMENT_ID    = time();
		$ORDER_AMOUNT  = $_POST['oa'];
		$sign = md5($MERCHANT_ID.':'.$ORDER_AMOUNT.':'.$SECRET_WORD.':'.$PAYMENT_ID);  //Генерация ключа

		//echo 'Location: https://enot.io/_/pay?m='.$MERCHANT_ID.'&oa='.$ORDER_AMOUNT.'&o='.$PAYMENT_ID.'&s='.$sign.'&cf='.$Nickplayer;

		header('Location: https://enot.io/_/pay?m='.$MERCHANT_ID.'&oa='.$ORDER_AMOUNT.'&o='.$PAYMENT_ID.'&s='.$sign.'&cf='.$login.'&c=Покупка донат-очков');
	}
}
if (isset($_POST['buyprem'])) {
	if ($myrow['status'] >= 5) {
		$adv = "<span style='color: #32CD32'>У Вас уже есть активированый статус \"Премиум\".</span>";
	}
	else {
		if ($myrow['donate'] < 40) {
			$adv = "<span style='color: #CD5C5C'>Недостаточно средств на балансе. Пожалуйста пополните счет.</span>";
		}
		else {
			$year = date("Y");
			$mothn = date("m");
			$day = date("d");
			$mothn ++;
			if ($mothn == 13) {
				$year ++;
				$mothn = 1;
			}
			$date = $day.".".$mothn.".".$year;
			$myrow['donate'] -= 40;
			$donate = $myrow['donate'];
			$id = $myrow['id'];
			mysql_query("UPDATE `Users$server` SET `donate` = '$donate', `status` = 5 WHERE `login` = '$login'", $db) or die(mysql_error());
			mysql_query("INSERT INTO `vips`(`Nick`, `Date`, `id`) VALUES ('$Nickplayer', '$date', '$id')", $db) or die(mysql_error());
			$adv = "<span style='color: #008000'>Вы успешно приобрели статус \"Премиум\". Что бы он начал действовать, перезагрузите скрипт.</span>";
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Донат | AHK by Wiberg</title>
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
	<div id="supportcontent">
		<H4><p><b>Добро пожаловать на страницу покупок. Здесь вы можете пополнить свой личный счет для покупок ништяков).</b></p></H4><br>
		 <form method='POST' action='donate.php'>
         <input type='hidden' name='m' value='<?=$MERCHANT_ID?>'>
         <input type='hidden' name='o' value='<?=$PAYMENT_ID?>'>
         <input type='hidden' name='s' value='<?=$sign?>'>
         <input type='hidden' name='cf' value='<?=$Nickplayer?>'>
         <input type='text' name='oa' placeholder="Сумма" style="height: 39px; width: 100px;">
         <button type="submit" name="submit_button" class="btn btn-success waves-effect waves-light indexbutton" style="margin-top: -0.4%">Оплатить</button>
         </form>
         <hr>
         <?php if (!empty($adv)) {
         	echo "".$adv."<hr>";
         } ?>
			<table class="donatetable">
			<thead>
			<tr>
			<th>Что входит</th>
			<th>Premium</th>
			</tr>
			</thead>
			<tbody>
			<tr class="gradientdonate"><td>Стоимость</td><td>₽40/мес.</td></tr>
			<tr>
			<td>Доступ к команде <span style="color: #FF0000">/премиум</span></td><td><img src="img/ok.svg" width="15px" height="15px"></td></tr>
			<tr>
			<td>Доступ к команде <span style="color: #FF0000">/помощник</span></td><td><img src="img/ok.svg" width="15px" height="15px"></td></tr>
			<tr>
			<td>Доступ к команде <span style="color: #FF0000">/adm</span></td><td><img src="img/ok.svg" width="15px" height="15px"></td></tr>
			<tr>
			<td>Доступ к команде <span style="color: #FF0000">/newrang</span></td><td><img src="img/ok.svg" width="15px" height="15px"></td></tr>
			<tr>
			<td>Функция авто ответа на последнее СМС</td><td><img src="img/ok.svg" width="15px" height="15px"></td></tr>
			<tr>
			<td>Напоминания о гос новостях</td><td><img src="img/ok.svg" width="15px" height="15px"></td></tr>
			<tr>
			<td>Авто исправления команд</td><td><img src="img/ok.svg" width="15px" height="15px"></td></tr>
			<tr>
			<td>Автозакуп в 24/7</td><td><img src="img/ok.svg" width="15px" height="15px"></td></tr>
			<tr>
			<td>Допольнительные строки в биндере</td><td><img src="img/ok.svg" width="15px" height="15px"></td></tr>
			<tr>
			<td>Бесплатная смена префикса в приветствии</td><td><img src="img/ok.svg" width="15px" height="15px"></td></tr>
			<tr>
			<td>/rec - автореконект на сервер</td><td><img src="img/ok.svg" width="15px" height="15px"></td></tr>
			<tr>
			<td>/sett - смена времени (визуально)</td><td><img src="img/ok.svg" width="15px" height="15px"></td></tr>
			<tr>
			<td>/setw - смена погоды (визуально)</td><td><img src="img/ok.svg" width="15px" height="15px"></td></tr>
			<tr>
			<td></td><td><form method="POST" action="donate.php"><button name="buyprem" type="submit" class="btn btn-success waves-effect waves-light indexbutton">Купить</button></form></td></tr>
			</tbody>
			</tr>
			</table>
		<footer><hr>Wiberg-prog ©2017-2020</footer>
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

<script type="text/javascript" src="https://vk.com/js/api/openapi.js?154"></script>

<!-- VK Widget -->
<div id="vk_community_messages"></div>
<script type="text/javascript">
VK.Widgets.CommunityMessages("vk_community_messages", 159176195, {tooltipButtonText: "Есть вопросы/предложения?"});
</script>

</body>
</html>