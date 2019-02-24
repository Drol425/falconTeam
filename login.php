<?
header('Content-Type: text/html; charset=utf-8');
// Страница авторизации
//print_r($_POST);
// Функция для генерации случайной строки
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
}

// Соединямся с БД
include('dbcon.php');

if(isset($_POST['submit']))
{
    // Вытаскиваем из БД запись, у которой логин равняеться введенному
    //$query = mysqli_query($db,"SELECT user_id, user_password FROM users WHERE user_login='".mysqli_real_escape_string($db,$_POST['login'])."' LIMIT 1");
    //$data = mysqli_fetch_assoc($query);
    $query = $DB->query("SELECT id,password FROM users WHERE login=?", array($_POST['login']));

    // Сравниваем пароли
    if($query[0]['password'] === md5(md5($_POST['password'])))
    {
        // Генерируем случайное число и шифруем его
        $hash = md5(generateCode(10));

        if(!empty($_POST['not_attach_ip']))
        {
            // Если пользователя выбрал привязку к IP
            // Переводим IP в строку
            $insip = ", user_ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."')";
        }

        // Записываем в БД новый хеш авторизации и IP
        //mysqli_query($db, "UPDATE users SET user_hash='".$hash."' ".$insip." WHERE user_id='".$data['user_id']."'");

        // Ставим куки
        setcookie("id", $query[0]['id'], time()+60*60*24*30);
        setcookie("hash", $hash, time()+60*60*24*30,null,null,null,true); // httponly !!!

        // Переадресовываем браузер на страницу проверки нашего скрипта
        header("Location: profil.php"); exit();
    }
    else
    {
        print "Вы ввели неправильный логин/пароль";
    }
}
?>
<html>
   <head>
      <title>Dating Trak</title>
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
   <div class="" id="Allcontent">
      
    <div class="InputForm justify-content-cente" id="InputForm">
            <form class="InputForm" action="" method="POST" id="Input">
                <h1>Вход</h1>
                <div>
                    <input class="ChoiceAt" name="login" type="text" id="InputMail" placeholder="Логин или почта">
                    <i class="fa geo" aria-hidden="true"></i>
                  </div>
                <div>
                    <input class="ChoiceAt" name="password" type="password" id="InputPassword" placeholder="Пароль">
                    <i class="fa calendar" aria-hidden="true"></i>
                </div>
                <button class="Mychoice" name="submit"  id="BtnInput">Войти</button>
                <p>Еще нет акаунта?</p>
                <a href="register.php" class="InputTo Reg">Зарегистрируйтесь</a>
            </form>
        </div>
   </div>
   <script src="D-js/D-js.js"></script>
</body>
</html>
