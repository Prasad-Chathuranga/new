<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
// global $language;
// DB credentials.
// define('DB_HOST','localhost');
// define('DB_USER','offtrfor_accountant_user');
// define('DB_PASS','y--I389ipnc]');
// define('DB_NAME','offtrfor_accountant');
// // // Establish database connection.
// try
// {
// $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
// }
// catch (PDOException $e)
// {
//     exit("Error: " . $e->getMessage());
// }



ob_start();
$servername = "localhost";
// $username = "theitlag_theitlag_theitlag_accou";
// $password = "aaYFbJ.W[MP8";
// $dbname = "theitlag_theitlag_accountant_v22";
$username = "root";
$password = "";
$dbname = "theitlag_theitlag_accountant_v22";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// $conn = mysqli_connect($servername, $username, $password, $dbname);

// $lang = isset($_COOKIE["lang"]) ? $_COOKIE["lang"] : 'en';
// $language = require_once "languages/".$lang.".php";

// function lang($word){
// 	$data = $GLOBALS["language"];
// 	return $data[$word];
// }

?>
 