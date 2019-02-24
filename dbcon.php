<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
define('DBHost', 'localhost');
define('DBName', '');
define('DBUser', '');
define('DBPassword', '');
include ('PDO.class.php');
$DB = new Db(DBHost, DBName, DBUser, DBPassword);
?>