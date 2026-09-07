<?php
// Local XAMPP defaults; on Railway set DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT
$db_host = getenv('DB_HOST') ?: 'localhost';
$db_user = getenv('DB_USER') ?: 'root';
$db_pass = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';
$db_name = getenv('DB_NAME') ?: 'developers';
$db_port = (int) (getenv('DB_PORT') ?: 3306);

$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
