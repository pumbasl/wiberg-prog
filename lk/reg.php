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
    if (isset($_POST['confirim_password'])) { $confirim_password=$_POST['confirim_password']; if ($confirim_password =='') { unset($confirim_password);} } 
      //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную 
    if (empty($Login) or empty($password) or empty($confirim_password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт 
    { 
      $error = "<span class='error'>Вы ввели не всю информацию, вернитесь назад и заполните все поля!</span>"; 
    }

    else{
      $Login = stripslashes($Login); 
      $Login = htmlspecialchars($Login); 
      $password = stripslashes($password); 
      $password = htmlspecialchars($password); 

      $confirim_password = stripslashes($confirim_password); 
      $confirim_password = htmlspecialchars($confirim_password); 
  //удаляем лишние пробелы 
      $Login = trim($Login); 
      $password = trim($password);   
      $confirim_password = trim($confirim_password);  
      $result = mysql_query("SELECT * FROM `UsersLK` WHERE `login`='$Login'",$db) or die(mysql_error());
      $myrow = mysql_fetch_array($result);
      //$result = mysql_query("SELECT * FROM UsersRed WHERE Nick='$Nick'",$db); //извлекаем из базы все данные о пользователе с введенным логином 
      //$myrow = mysql_fetch_array($result); 
      if (isset($myrow['login'])) 
      { 
        $error = "<span class='error'>Извините, выбранный Вами логин уже занят.</span>"; 
      }
      else { 
        if ($password != $confirim_password) {
          $error = "<span class='error'>Извините, пароли не совпадают.</span>"; 
        }
        else{
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
          $password = password_hash($password, PASSWORD_DEFAULT);
          mysql_query("INSERT INTO `UsersLK`(`login`, `password`, `server`, `regdate`) VALUES ('$Login', '$password', '', '')", $db) or die(mysql_error());
          $_SESSION['succreg']='<span class="color: #ff00ff">Вы успешно зарегестрировали акаунт, теперь можете войти в него.</span>';
          header("location: /lk/login.php");
        }
      }
    } 
	}
?> 
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf8">
  <title>Регистрация | AHK by Wiberg</title>
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
			echo "<li><a href='login.php'>Авторизоваться</a></li>";
      echo "<li class='selected'><a href='reg.php'>Регистрация</a></li>";
		}else{
			echo "<li><a href='logout.php'>Выйти</a></li>";
		} ?>
	</ul>
</div>

  <div id="contet">
    <form action="reg.php" method="POST">
  <div class="login-form">
     <h1 class="textlogin">Регистрация</h1>
     <?php if(isset($error))
      {
        echo "<p>" .$error. "</p>";
      }?>
     <div class="form-group">
       <input type="text" class="form-control" placeholder="Логин " id="Login" name="login">
       <i class="fa fa-user"></i>
     </div>
     <div class="form-group">
       <input type="password" class="form-control" placeholder="Пароль" id="Passwod" name="password">
       <i class="fa fa-lock"></i>
     </div>
     <div class="form-group">
       <input type="password" class="form-control" placeholder="Повтор пароля" id="Confirim_Password" name="confirim_password">
       <i class="fa fa-lock"></i>
     </div>
     <!--<p><select name="org">
     	<option value="0">Выберите организацию</option>
		<option value="1">Министерство Обороны</option>
		<option value="2">Министерство здравоохранения</option>
	</select></p>-->
     <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" /><br/><br/>
     <button type="submit" class="log-btn" name="do_login">Зарегестрировать</button>
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