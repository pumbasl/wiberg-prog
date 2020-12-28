<?php
session_start(); 
include ("bd.php");  
define('SITE_KEY', '6LfZrrIZAAAAANP5Zllv4HqSHgpvYIGElqnAKeGq');
define('SECRET_KEY', '6LfZrrIZAAAAAOipN-7iVlt4vbDptkuGrGnUW8jj');
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

if (isset($_POST['submit_button'])) {
	if (!empty($_POST['login_email'])) {
		$checkvar = $_POST['login_email'];
		$result = mysql_query("SELECT * FROM `UsersLK` WHERE `login` = '$checkvar' OR `email` = '$checkvar' LIMIT 1", $db) or die(mysql_error());
		$myrow = mysql_fetch_array($result);
		if (!empty($myrow['login'])) {
			if ($myrow['email'] != '') {
				function getCaptcha($SecretKey) {
                    $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response={$SecretKey}");
                    $Return = json_decode($Response);
                    return $Return;
                }

                /*ПРОИЗВОДИМ ЗАПРОС НА GOOGLE СЕРВИС И ЗАПИСЫВАЕМ ОТВЕТ*/
                $Return = getCaptcha($_POST['g-recaptcha-response']);
                /*ВЫВОДИМ НА ЭКРАН ПОЛУЧЕННЫЙ ОТВЕТ*/

                /*ЕСЛИ ЗАПРОС УДАЧНО ОТПРАВЛЕН И ЗНАЧЕНИЕ score БОЛЬШЕ 0,5 ВЫПОЛНЯЕМ КОД*/
                if($Return->success == true && $Return->score > 0.5){
                    $robotcheck = '0';
                }
                else {
                    $robotcheck = '1';
                    die("Ты бот, фу фу фу.");
                }
				$_SESSION['login_restore'] = $myrow['login'];
				$_SESSION['email_restore'] = $myrow['email'];

				$_SESSION['emailuser'] = $_POST['login_email'];
				$_SESSION['emailcod'] = time();
				$_SESSION['email_page'] = 'restore_password.php';
				$_SESSION['subject'] = 'Восстановления пароля.';
				$_SESSION['body'] = 'Ваш код: '.$_SESSION['emailcod'];
				$_SESSION['phase'] = 1;
				header('location: mail.php');
			}
			else {
				$error = 'Ошибка. К данному акаунту не привязана почта. Обратитесь в личные сообщения в ВК. <a href="https://vk.com/im?sel=212366734">Написать сообщение</a>';
			}
		}
		else {
			$error = 'Ошибка. Акаунта с данным логиным или электронной почтой не было найдено.';
		}
	}
	else {
		$error = 'Ошибка. Все поля не были заполнены';
	}
}

if (isset($_POST['submit_button2'])) {
	if (!empty($_POST['code_email'])) {
		if ($_SESSION['emailcod'] == $_SESSION['emailcod']) {
			$_SESSION['phase'] = 2;
		}
		else {
			$error = 'Ошибка. Код введен не верно.';
		}
	}
	else {
		$error = 'Ошибка. Вы не заполнили поле с кодом.';
	}
}

if (isset($_POST['submit_button3'])) {
	if (!empty($_POST['new_password_email']) or !empty($_POST['new_password_repeat_email'])) {
		if ($_POST['new_password_email'] == $_POST['new_password_repeat_email']) {
			$password = stripslashes($_POST['new_password_email']);
        	$password = htmlspecialchars($password);
        	$password = trim($password);
        	$password = password_hash($password, PASSWORD_DEFAULT);
        	$login_restore = $_SESSION['login_restore'];
        	mysql_query("UPDATE `UsersLK` SET `password` = '$password' WHERE `login` = '$login_restore'",$db) or die(mysql_error());
        	$_SESSION['phase'] = 0;
        	header("location: login.php");
		}
		else {
			$error = 'Ошибка. Пароли не совпадают.';
		}
	}
	else {
		$error = 'Ошибка. Вы не заполнили все поля.';
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Восстановление пароля | AHK by Wiberg</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
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
		<h3>Восстановления пароля:</h3><hr>
		<?php if (!empty($error)) {
			echo $error;
			unset($error);
		} if ($_SESSION['phase'] != 1 and $_SESSION['phase'] != 2) {
			echo "<form action='restore_password.php' method='POST'><p>Введите Ваш адрес электронной почты или логин от акаунта Личного Кабинета: <input type='text' name='login_email'></p>
			<button type='submit' name='submit_button'>Проверить</button><input type='hidden' id='g-recaptcha-response' name='g-recaptcha-response' /></form>";
		} if ($_SESSION['phase'] == 1) {
			echo "<p>На Вашу почту был выслан код подтверждения</p><form action='restore_password.php' method='POST'><p>Введите код: <input type='text' name='code_email'></p>
			<button type='submit' name='submit_button2'>Отправить</button><input type='hidden' id='g-recaptcha-response' name='g-recaptcha-response' /></form>";
		} if ($_SESSION['phase'] == 2) {
			echo "<p>Введите новый пароль</p><form action='restore_password.php' method='POST'><p>Введите новый пароль: <input type='text' name='new_password_email'></p><p>Повторите новый пароль: <input type='text' name='new_password_repeat_email'></p>
			<button type='submit' name='submit_button3'>Отправить</button><input type='hidden' id='g-recaptcha-response' name='g-recaptcha-response' /><br/><br/></form>";
		} ?>
		<hr><footer>Wiberg-prog ©2017-2020</footer>
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
$('.nav-toggle').on('click', function(){
  $('#sidebar').toggleClass('active');
});
</script>

<!-- Гугл капча -->

<script src="https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY?>"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('<?php echo SITE_KEY;?>', {action: 'homepage'}).then(function(token) {
            //console.log(token);
            document.getElementById('g-recaptcha-response').value=token;
        });
    });
</script>

</body>
</html>