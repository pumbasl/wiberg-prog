<?php
session_start();
include ("bd.php");  
$login = $_SESSION['login'];

$file = $_FILES['file']['tmp_name'];
$filename = $_FILES['file']['name'];
if(!empty($file))
{
  ini_set('memory_limit', '32M'); 
  $maxsize = "100000000";
  $extentions = array("mp3");
  $size = filesize ($_FILES['file']['tmp_name']); 
  $type = strtolower(substr($filename, 1+strrpos($filename,".")));
  $result = mysql_query("SELECT * FROM `UsersLK` WHERE `login` = '$login'", $db) or die(mysql_error());
  $myrowlk = mysql_fetch_array($result);
  $nick = $myrowlk['nickname_account'];
  $server = $myrowlk['server'];
  $new_name = ''.$nick.'@'.$server.'.'.$type;
  if($size > $maxsize)
  { 
     echo "Файл больше 100 мб. Уменьшите размер вашего файла или загрузите другой. <br><a href='' onClick=window.close();>Закрыть окно</a>";
  }
  elseif(!in_array($type,$extentions)) 
  { 
    echo ' <b>Файл имеет недопустимое расширение</b>. Допустимыми являются форматы .mp3. <br>';
  } 
  else 
  { 
    if (copy($file, "music/".$new_name)){
      echo "Файл загружен, вы будете перенаправлены через 5 секунды.";
    }
    else echo "Файл НЕ был загружен.";
  }  
  sleep(5);
   echo '<script>location.replace("/lk/ring.php");</script>'; exit;
}
else
{
	echo "ОШИБКА 4";
}
?>