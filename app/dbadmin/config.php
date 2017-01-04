<?php
require_once("db_access.php");
//$database = new dbAccess('sqlite:./db/quansis.sq3');	//new PDO( 'sqlite:./puzzles.sq3');
$dsn = 'mysql:host=xavok.cfhnqtuiwvzq.us-west-2.rds.amazonaws.com;dbname=quansisdb;';
$username = 'xavok';
$password = '10UoazRj90N3';
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

$database = new dbAccess($dsn, $username, $password, $options);
//var_dump($database);


//$conn = new mysqli($dsn, $username, $password, "");
// Check connection
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//}

require_once("login-ndb.php");
$login = new login($database, 86400, true);
//$login->sessions_clean();
$user = $login->login(true);
define ('SELECTLENGTH', 20);
define ('BASEDIR', dirname(__FILE__).'/');
?>
