<?php 
// global $language;
// DB credentials.
// define('DB_HOST','localhost');
// define('DB_USER','root');
// define('DB_PASS','');
// define('DB_NAME','bitting room');
// // Establish database connection.
// try
// {
// $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
// }
// catch (PDOException $e)
// {
// exit("Error: " . $e->getMessage());
// }



ob_start();
$servername = "localhost";
$username = "root";
$password = "";

$dbname = "theitlag_theitlag_accountant_v22";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// $lang = isset($_COOKIE["lang"]) ? $_COOKIE["lang"] : 'en';
// $language = require_once "./../languages/".$lang.".php";

// function lang($word){
// 	$data = $GLOBALS["language"];
// 	return $data[$word];
// }
?>