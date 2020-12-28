<?php
session_start(); 
include ("bd.php");  
require('inc/headerlogins.inc');
define('SITE_KEY', '6LfZrrIZAAAAANP5Zllv4HqSHgpvYIGElqnAKeGq');
define('SECRET_KEY', '6LfZrrIZAAAAAOipN-7iVlt4vbDptkuGrGnUW8jj');
$login = $_SESSION['login'];
$result = mysql_query("SELECT * FROM `UsersLK` WHERE `login` = '$login'", $db) or die(mysql_error());
$myrowlk = mysql_fetch_array($result);
$server = $myrowlk['server'];
if ($myrowlk['nickname_account'] != '') {
	$result = mysql_query("SELECT * FROM `Users$server` WHERE `login` = '$login'", $db) or die(mysql_error());
	$myrow = mysql_fetch_array($result);
}

$Nickplayer = $myrowlk['nickname_account'];

if (isset($_POST['sumbit_button'])) {
	$data = $_POST;
    $name = $data['name'];
    $email = $data['email'];
    $text = $data['text'];

    if (empty($name) or empty($email) or empty($text)) {
    	$succsec = '<span class="error">Вы не заполнили одно из полей.</span>';
    }
    else {
    	$text = stripslashes($text); 
	    $text = htmlspecialchars($text);
	    $email = htmlspecialchars($email);
	    $email = stripslashes($email); 
	    $name = htmlspecialchars($name);
	    $name = stripslashes($name); 

	    $date = date("d.m.Y");
	    $time = date("H:i:s");

		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		    $ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
		    $ip = $_SERVER['REMOTE_ADDR'];
		}
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
	    mysql_query("INSERT INTO `Feedback` (`Name`, `Email`, `Text`, `Date`, `Time`, `IP`) VALUES ('$name', '$email', '$text', '$date', '$time', '$ip')") or die(mysql_error());
		$succsec = '<span style="color: #00ff00;">Вы успешно отправили сообщение.</span>';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Тех поддержка | AHK by Wiberg</title>
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
			<li><a href="support.php" class="selected">Контакты</a></li>
			<?php if (empty($_SESSION['login'])) {
				echo "<li><a href='login.php'>Авторизоваться</a></li>";
				echo "<li><a href='reg.php'>Регистрация</a></li>";
			}else{
				echo "<li><a href='logout.php'>Выйти</a></li>";
			} ?>
		</ul>
	</div>
	<div id="supportcontent">
		<h4>Наши контакты:</h4>
		Skype: pumbasl<br>
		Email: support@wiberg-prog.ru</p>
		<h4>Форма обратной связи:</h4>
		<?php if (isset($succsec)) {
			echo "" .$succsec;
		} ?>
		<p>Здесь вы сможете задать любой вопрос на который в скором времене получите ответ по Email.</p><hr>
		<form method="POST" action="support.php" name="contact_form" class="contact_form">
			<p>Введите Ваше имя: <input type="text" placeholder="Имя" name="name"></p>
			<p>Введите Ваш Email: <input type="email" placeholder="Email" name="email"></p>
			<p><textarea class="supportarea" cols="70" rows="5" maxlength="1000" placeholder="Ваш текст" name="text"></textarea></p>
			<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" /><br/><br/>
			<p><button type="sumbit" name="sumbit_button" class="btn btn-success waves-effect waves-light indexbutton">Отправить</button></p>
		</form>
		<footer>Wiberg-prog ©2017-2020</footer>
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