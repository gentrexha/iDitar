<?php
error_reporting(0);
try {
		$dbConn = mysqli_connect('localhost','root','','iditari');

   // $dbConn = mysqli_connect($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);
} catch (Exception $ignore) {
}
?>
