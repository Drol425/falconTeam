<?php
    include('dbcon.php');
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
    //$query = mysqli_query($db, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
   // $userdata = mysqli_fetch_assoc($query);
$query =  $DB->query("SELECT id FROM users WHERE id =?", array($_COOKIE['id']));
    if($query[0]['id'] !== $_COOKIE['id'])
    {
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/");
        print "Хм, что-то не получилось";
    }
    else
    {

      if(isset($_POST['submit']) AND isset($_POST['time']) AND isset($_POST['geo'])){
      $geo = $_POST['geo'];
      $time = $_POST['time'];
      $pieces = explode("+", $geo);
        $DB->query("INSERT INTO `h6072_diplo`.`tags` (`id`, `id_user`, `x`, `y`, `times`, `text`) VALUES (?, ?, ?, ?, ?, ?)",array(NULL,$_COOKIE['id'],$pieces[0],$pieces[1],$time,'1' ));
      header("Location: search.php");
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
      <link id="theme-style" rel="stylesheet" href="D-css/SearchLoveAccount.css">
      
      <!--script defer src="js/garlic.js"></script-->
   </head>
<body class="center-block" id="body">
   <div class="justify-content-center" id="Allcontent">
      <header class="">
         <div class="content">
             <div class="logo">
                 <img src="D-IMG/logo.png" alt="Наш сайт знакомств">
             </div>
             <div class="InputLogin">
                      <?php
      $id_user = $_COOKIE['id'];
$user = $DB->query("SELECT * FROM `users` WHERE id=?",array($id_user));


      ?>
                 <a href="" class="a nickname"><?php echo $user[0]['login'] ?></a>
                 <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0.915039 24.0722C7.45481 17.9614 19.0214 18.9015 24.0971 24.0722" stroke="#6B6B6B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M9.68753 11.3805C8.54445 10.687 7.68833 9.5966 7.27802 8.31168C6.86772 7.02677 6.93108 5.63457 7.45637 4.39343C7.98165 3.15228 8.93319 2.14647 10.1344 1.56262C11.3356 0.978774 12.705 0.856538 13.9883 1.21859C15.2717 1.58065 16.3819 2.40242 17.113 3.53141C17.8442 4.6604 18.1465 6.01995 17.964 7.35779C17.7814 8.69562 17.1264 9.92091 16.1204 10.8063C15.1145 11.6916 13.8259 12.177 12.4938 12.1722C11.5042 12.1762 10.5329 11.9022 9.68753 11.3805" stroke="#6B6B6B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
         </div>
      </header>
      <div class="Account content">
          <img src="D-IMG/Rectangle.png" alt="" class="AccountImg">
          <div>
            <h1><?php echo $user[0]['name'] ?></h1>
            <button class="btnEdit"></button>
          </div>
          <div>
            <h2 class="AccountAge"><?php echo $user[0]['age'] ?></h2>,
            <h2 class="AccountCity">г. Киев</h2>
            <button class="btnEdit"></button>
          </div>
          <div class="AccountAbout">
                <p class="AccountAboutp"> <?php echo $user[0]['description'] ?>
                </p>
                <button class="btnEdit"></button>
          </div>
      </div>
      <div class="NewLabelBlock row justify-content-center content">
         <div>
          <form method="POST">
            <input class="ChoiceAt" name="geo" type="text" onclick="geoSet()" id="geo" placeholder="Укажите местоположение">
            <i class="fa geo" aria-hidden="true"></i>
      </div>
         <div>
            <input class="ChoiceAt" name="time" type="time" id="Time" placeholder="Укажите время">
            <i class="fa calendar" aria-hidden="true"></i>
      </div>
            <button type="submit" name="submit" class="NewMeeting"><h3>Создать встречу</h3></button>
          </form>
      </div>

     <div class="CenterContent justify-content-center">
           <!-- <div class="CenterBlock">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d85701.9869457209!2d35.10413999240061!3d47.83596874275215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40dc5e09673d08d9%3A0xfa4eff7f6c190832!2z0L_Qu9C-0YnQsNC00Ywg0KPQvdC40LLQtdGA0YHQuNGC0LXRgtGB0LrQsNGPLCDQl9Cw0L_QvtGA0L7QttGM0LUsINCX0LDQv9C-0YDQvtC20YHQutCw0Y8g0L7QsdC70LDRgdGC0YwsIDY5MDAw!5e0!3m2!1sru!2sua!4v1546610363432" width="100%" height="450px" frameborder="0" style="border:0" allowfullscreen></iframe>
           </div>
           <div class="AccountLabel">
               
           </div> -->
     </div>
     <footer class="row justify-content-center">
            <a href="" class="Falcon">Made by FalconTeam for INT20H</a>
        </footer> 
   </div>
   <script src="D-js/D-js.js"></script>
</body>
</html>
<script type="text/javascript">
function geoSet(){



navigator.geolocation.getCurrentPosition(function(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            //alert(latitude +'+'+longitude);
            document.getElementById('geo').value = latitude +'+'+longitude;
        });}
</script>
<?php
    }}
?>