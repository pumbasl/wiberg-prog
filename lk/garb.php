<?php
session_start(); 
include ("bd.php");  

if (empty($_SESSION['login'])) 
{ 
	// Если пусты, то мы не выводим ссылку 
	$_SESSION['link'] = 'garb.php';
	header('location: /lk/login.php');
	}
else{

		$login = $_SESSION['login'];
		$result = mysql_query("SELECT * FROM `UsersLK` WHERE `login` = '$login'", $db) or die(mysql_error());
		$myrowlk = mysql_fetch_array($result);
		$server = $myrowlk['server'];
		$Nickplayer = $myrowlk['nickname_account'];
		if ($Nickplayer == '') {
			# code...
		}
		else
		{
			$result = mysql_query("SELECT * FROM `Users$server` WHERE `login` = '$login'", $db) or die(mysql_error());
			$myrow = mysql_fetch_array($result);
		}
		require('inc/headerlogins.inc');
		$Nickplayer = $_SESSION['Nick'];
		$num = 15;
		$page = $_GET['page'];
		$result = mysql_query("SELECT COUNT(*) FROM garb"); 
		$posts = mysql_fetch_row($result);
		$total = (intval($posts[0]) - 1) / $num + 1;
		$page = intval($page);
		if(empty($page) or $page < 0) $page = 1; 
		  if($page > $total) $page = $total;
		  $start = $page * $num - $num; 
		  $result = mysql_query("SELECT * FROM garb LIMIT $start, $num"); 
		  while ( $postrow[] = mysql_fetch_array($result));
		}

if (!empty($_POST)) {
	$idgarb = $_POST['sumbit_button'];
	$pages = $_SESSION['page'];
	mysql_query("UPDATE `garb` SET `Make` = 1 WHERE `newid` = '$idgarb'");
	header("location: /lk/garb.php?page=$pages");
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Наряды | AHK by Wiberg</title>
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
			<li><a href="garb.php" class="selected">Наряды</a></li>
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
	<?php  
	for ($i = 0; $i < $num; $i++) { 
		if (empty($postrow[$i]['Reason'])) {
			# code...
		}
		else
		{
			if ($postrow[$i]['Make'] == "0") {
				if ($myrow['status'] == '6' or $myrow['status'] == '7' or $myrow['status'] == '4' or $myrow['Rangname'] == 'Адмирал') {
					$postrow[$i]['Reason'] = str_replace("@", " ", $postrow[$i]['Reason']);
					echo "<form action='garb.php' method='POST'><div id='garbcontentnomake'><h4><b><p>Наряд на военнослужащего | Выдал: <span class='garbmaintext'>" .$postrow[$i]['Nickgive']. "</span> <button class='btn btn-success waves-effect dategarb'>" .$postrow[$i]['Date']. " " .$postrow[$i]['Time']. "</button></p><p>Имя и фамилия военнослужащего: <span class='garbmaintext'>" .$postrow[$i]['Nick']. "</span> получил наряд в виде <span class='garbmaintext'>" .$postrow[$i]['amount']. " торпед</span> от офицера <span class='garbmaintext'>" .$postrow[$i]['Nickgive']. "</span> | Причина выдачи наряда: <span class='garbmaintext'>" .$postrow[$i]['Reason']. "</span><button type='submit' name='sumbit_button' value='" .$postrow[$i]['newid']. "' class='btn btn-success waves-effect deletegarb'>Пометить как выполненный</button></b></p></h4></div></form>";
				}
				else
				{
					$postrow[$i]['Reason'] = str_replace("@", " ", $postrow[$i]['Reason']);
					echo "<form action='garb.php' method='POST'><div id='garbcontentnomake'><h4><b><p>Наряд на военнослужащего | Выдал: <span class='garbmaintext'>" .$postrow[$i]['Nickgive']. "</span> <button class='btn btn-success waves-effect dategarb'>" .$postrow[$i]['Date']. " " .$postrow[$i]['Time']. "</button></p><p>Имя и фамилия военнослужащего: <span class='garbmaintext'>" .$postrow[$i]['Nick']. "</span> получил наряд в виде <span class='garbmaintext'>" .$postrow[$i]['amount']. " торпед</span> от офицера <span class='garbmaintext'>" .$postrow[$i]['Nickgive']. "</span> | Причина выдачи наряда: <span class='garbmaintext'>" .$postrow[$i]['Reason']. "</span></b></p></h4></div></form>";
				}
			}
			else
			{
				$postrow[$i]['Reason'] = str_replace("@", " ", $postrow[$i]['Reason']);
				echo "<div id='garbcontentmake'><h4><b><p>Наряд на военнослужащего | Выдал: <span class='garbmaintext'>" .$postrow[$i]['Nickgive']. "</span> <button class='btn btn-success waves-effect dategarb'>" .$postrow[$i]['Date']. " " .$postrow[$i]['Time']. "</button></p><p>Имя и фамилия военнослужащего: <span class='garbmaintext'>" .$postrow[$i]['Nick']. "</span> получил наряд в виде <span class='garbmaintext'>" .$postrow[$i]['amount']. " торпед</span> от офицера <span class='garbmaintext'>" .$postrow[$i]['Nickgive']. "</span> | Причина выдачи наряда: <span class='garbmaintext'>" .$postrow[$i]['Reason']. "</span></b></p></h4></div>";
			}
			$_SESSION['page'] = $page;
		}
	}

	if ($page != 1) $pervpage = '<a href= ./garb.php?page=1><<</a> 
                               <a href= ./garb.php?page='. ($page - 1) .'><</a> '; 
	// Проверяем нужны ли стрелки вперед 
	if ($page != $total) $nextpage = ' <a href= ./garb.php?page='. ($page + 1) .'>></a> 
	                                   <a href= ./garb.php?page=' .$total. '>>></a>'; 

	// Находим две ближайшие станицы с обоих краев, если они есть 
	if($page - 2 > 0) $page2left = ' <a href= ./garb.php?page='. ($page - 2) .'>'. ($page - 2) .'</a> | '; 
	if($page - 1 > 0) $page1left = '<a href= ./garb.php?page='. ($page - 1) .'>'. ($page - 1) .'</a> | '; 
	if($page + 2 <= $total) $page2right = ' | <a href= ./garb.php?page='. ($page + 2) .'>'. ($page + 2) .'</a>'; 
	if($page + 1 <= $total) $page1right = ' | <a href= ./garb.php?page='. ($page + 1) .'>'. ($page + 1) .'</a>'; 

	// Вывод меню 
	echo "<div id='pagenumber'>" .$pervpage.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$nextpage. "</div>"; 

	?>

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

<script type="text/javascript" src="https://vk.com/js/api/openapi.js?154"></script>

<!-- VK Widget -->
<div id="vk_community_messages"></div>
<script type="text/javascript">
VK.Widgets.CommunityMessages("vk_community_messages", 159176195, {tooltipButtonText: "Есть вопросы/предложения?"});
</script>

</body>
</html>