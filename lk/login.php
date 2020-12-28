<?php
	session_start(); 
	include ("bd.php");  
  define('SITE_KEY', '6LfZrrIZAAAAANP5Zllv4HqSHgpvYIGElqnAKeGq');
  define('SECRET_KEY', '6LfZrrIZAAAAAOipN-7iVlt4vbDptkuGrGnUW8jj');
	mysql_set_charset("utf8");
	$resultat = mysql_query("SELECT COUNT(1) FROM `UsersRed`", $db) or die(mysql_error());;
	$mysq = mysql_fetch_array($resultat);
	$id = $mysq['0'];
	$org = $_POST['org'];
  $date = date("d.m.Y");
  $daterestlt = mysql_query("SELECT COUNT(1) FROM `Logs` WHERE `Date` = '$date' AND `comment` = 'Авторизовался в личном кабинете.'", $db) or die(mysql_error());
	$myrowtime = mysql_fetch_array($daterestlt);


	if (isset($_POST['do_login']))
	{
		if (isset($_POST['login'])) { $Login = $_POST['login']; if ($Login == '') { unset($Login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную 
        if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} } 
        //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную 
        if (empty($Login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт 
        { 
         $error = "<span class='error'>Вы ввели не всю информацию, вернитесь назад и заполните все поля!</span>"; 
        } 
        //если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести 
        $Login = stripslashes($Login); 
        $Login = htmlspecialchars($Login); 
        $password = stripslashes($password); 
        $password = htmlspecialchars($password); 
//удаляем лишние пробелы 
        $Login = trim($Login); 
        $password = trim($password);   
// подключаемся к базе 
      	$result = mysql_query("SELECT * FROM `UsersLK` WHERE `login`='$Login'",$db) or die(mysql_error());
      	$myrow = mysql_fetch_array($result);
        //$result = mysql_query("SELECT * FROM UsersRed WHERE Nick='$Nick'",$db); //извлекаем из базы все данные о пользователе с введенным логином 
        //$myrow = mysql_fetch_array($result); 
        if (empty($myrow['password'])) 
        { 
        //если пользователя с введенным логином не существует 
        	$error = "<span class='error'>Извините, введённый вами Логин или пароль неверный. Или вы не выбрали свою организацию</span>"; 
        } 
        else { 
            if (password_verify($password, $myrow['password']) and empty($error)){    
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
                $_SESSION['login'] = $myrow['login'];  
                $link = $_SESSION['link'];
                mysql_query("UPDATE `UsersLK` SET `lastseen` = '$date' WHERE `login` = '$Login'",$db) or die(mysql_error());
                header("location: /lk/$link");
             } 
     else { 
    //если пароли не сошлись 

    		$error = "<span class='error'>Извините, введённый вами Логин или пароль неверный. Или вы не выбрали свою организацию</span>"; 
        } 
    } 
	}
?> 
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf8">
  <title>Авторизация | AHK by Wiberg</title>
  <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="css/ind.css">
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
  <link rel="stylesheet" type="text/css" href="css/test.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="header">
		<a href="/lk"><img src="img/logo.png" height="45px" class="logo"></a>
		<ul>
			<li><a href="ring.php">Загрузить рингтон</a></li>
			<li><a href="#">Запусков за сегодня: <?php echo "" .$myrowtime['0']; ?></a></li>
			<li><a href="#">Всего пользователей: <?php echo "" .$id; ?></a></li>
      <li><div class="nav-toggle"><span></span></div></li>
		</ul>
	</div>
  <div id="sidebar" class="visible">
    
    <ul>
		<li><a href="/">Главная</a></li>
      <li><a href="/lk">Личный кабинет</a></li>
      <li><a href="donate.php">Купить премиум</a></li>
      <li><a href="help.php">Установка</a></li>
      <li><a href="garb.php">Наряды</a></li>
      <li><a href="download.php">Скачивание</a></li>
      <li><a href="news.php">Новости AHK</a></li>
      <li><a href="post.php">Время с постов</a></li>
      <li><a href="owners.php">Создатели</a></li>
      <li><a href="support.php">Контакты</a></li>
		<?php if (empty($_SESSION['login'])) {
			echo "<li class='selected'><a href='login.php'>Авторизоваться</a></li>";
      echo "<li><a href='reg.php'>Регистрация</a></li>";
		}else{
			echo "<li><a href='logout.php'>Выйти</a></li>";
		} ?>
	</ul>
</div>

  <div id="contet">
    <form action="login.php" method="POST">
  <div class="login-form">
     <h1 class="textlogin">Вход</h1>
     <?php if(isset($error))
      {
        echo "<p>" .$error. "</p>";
      } 
      if (isset($_SESSION['succreg'])) {
        echo "<p>" .$_SESSION['succreg']. "</p>";
        unset($_SESSION['succreg']);
      }
      ?>
     <div class="form-group">
       <input type="text" class="form-control" placeholder="Логин " id="Login" name="login">
       <i class="fa fa-user"></i>
     </div>
     <div class="form-group">
       <input type="password" class="form-control" placeholder="Пароль" id="Passwod" name="password">
       <i class="fa fa-lock"></i>
     </div>
     <!--<p><select name="org">
     	<option value="0">Выберите организацию</option>
		<option value="1">Министерство Обороны</option>
		<option value="2">Министерство здравоохранения</option>
	</select></p>-->
	 <a href="restore_password.php">Забыл пароль?</a><br><br>
   <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" /><br/><br/>
     <button type="submit" class="log-btn" name="do_login">Войти</button>
     <footer>Wiberg-prog ©2017-2020</footer>
   </div>
 </form>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="js/index.js"></script>
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