<?php
	//exit();
    header('Content-Type: text/html; charset=utf-8');
// Страница регистрации нового пользователя

// Соединямся с БД
include('dbcon.php');
function incrementalHash($len = 8){
  $charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
  $base = strlen($charset);
  $result = '';

  $now = explode(' ', microtime())[1];
  while ($now >= $base){
    $i = $now % $base;
    $result = $charset[$i] . $result;
    $now /= $base;
  }
  return substr($result, -5);
}

if(isset($_POST['submit']))
{
    $err = [];

    // проверям логин
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    }

    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
    {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }

    // проверяем, не сущестует ли пользователя с таким именем
    //$query = mysqli_query($db, "SELECT user_id FROM users WHERE user_login='".mysqli_real_escape_string($db, $_POST['login'])."'");
     $query =  $DB->query("SELECT COUNT(id) FROM users WHERE login=?", array($_POST['login']));
   // print_r($query[0]['COUNT(user_id)']);
    if($query[0]['COUNT(user_id)'] > 0)
    {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }

    // Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0)
    {

        $login = $_POST['login'];

        // Убераем лишние пробелы и делаем двойное хеширование
        $password = md5(md5(trim($_POST['password'])));

       //mysqli_query($db,"INSERT INTO users SET user_login='".$login."', user_password='".$password."'");
       
        $DB->query("INSERT INTO users(id,login,password) VALUES(?,?,?)", array(null,$login, $password));
       //$user_id = $DB->lastInsertId();
       
        //$api_key =  incrementalHash();
       
       //$DB->query("INSERT INTO api_key(id,api_key,site,id_user) VALUES(?,?,?,?)", array(null,$api_key,"",$user_id));
       //
      //$id_api_key = $DB->lastInsertId();
       
       //$DB->query("UPDATE users SET apikey_id = ? WHERE user_login = ?", array($id_api_key, $login));
       
       //$DB->query("INSERT INTO limit_user(`id`, `id_user`, `limit_key`, `limit_post`) VALUES(?,?,?,?)", array(NULL, $user_id, '1000', '400'));
       
        //mysqli_query($db,"INSERT INTO `limit_user` (`id`, `id_user`, `limit_key`, `limit_post`) VALUES (NULL, '$user_id', '1000', '400')");
        
        //mysqli_query($db,"INSERT INTO `setting` (`id`, `id_user`, `name`, `value`) VALUES (NULL, '$user_id', 'links', '5')");
        //$DB->query("INSERT INTO setting(`id`, `id_user`, `name`, `value`) VALUES(?,?,?,?)", array(NULL, $user_id, 'links', '5'));
       // mysqli_query($db,"IINSERT INTO `setting` (`id`, `id_user`, `name`, `value`) VALUES (NULL, '$user_id', 'links', '5')");
        
        header("Location: login.php"); exit();
    }
    else
    {
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
}
?>
<html>
   <head>
      <title>Dating Track</title>
      <!-- Meta -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Режим для инт. эксплорэра - последний -->
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="keywords" content="Diplom.com, Diplom Educafion, Search Teachers">
      <meta name="description" content="Diplom.com, Diplom Educafion, Search Teachers">
      <meta name="author" content="Diplom.com, Diplom Educafion, Search Teachers">    
      <link rel="shortcut icon" href="Da.ico"> <!-- Иконка вкладки Vladimir Samkov, Oksana Popova -->
      <!-- Гугл шрифты -->
      <link href="https://fonts.googleapis.com/css?family=Ubuntu:700" rel="stylesheet">
            
      <!-- Global CSS -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <!--link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.css"-->   
      <!-- Plugins CSS -->
      <link rel="stylesheet" href="D-plugins/font-awesome/css/font-awesome.css">
      <!-- Theme CSS -->  
      <link id="theme-style" rel="stylesheet" href="D-css/SearchLove.css">
      
      <!--script defer src="js/garlic.js"></script-->
   </head>
<body class="center-block" id="body">
   <div class="justify-content-center" id="Allcontent">
      
    <div class="InputForm justify-content-cente" id="InputForm">
            <form class="InputForm" action="" method="POST" id="Input">
                <h1>Регистрация</h1>
                <div>
                    <input class="ChoiceAt" name="login" type="text" id="InputMail" placeholder="Электронная почта">
                    <i class="fa geo" aria-hidden="true"></i>
                  </div>
                <div>
                    <input class="ChoiceAt" name="password" type="password" id="InputPassword" placeholder="Пароль">
                    <i class="fa calendar" aria-hidden="true"></i>
                </div>
                <div>
                    <input class="ChoiceAt" type="text" id="InputPassword" placeholder="Подтвердите пароль">
                    <i class="fa calendar" aria-hidden="true"></i>
                </div>
                <button class="Mychoice" name="submit"  id="BtnInput">Регистрация</button>
            </form>
        </div>
   </div>
   <script src="D-js/D-js.js"></script>
</body>
</html>
