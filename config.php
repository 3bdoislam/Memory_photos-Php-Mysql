<?php error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>
<?php
//$dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass)
$host = "localhost";
$dbhname = "file_upload";
$user = "root";
$password = "";
$dsn = 'mysql:host='. $host . ';dbname=' . $dbhname;

$dbh = new PDO($dsn, $user, $password);


?>