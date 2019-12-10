<?php
/******Configueration to connect to Google Cloud Platform SQL Database******/
// set error reporting on to help with debugging
error_reporting(E_ALL);
ini_set('display_errors', '1');

define('DBCONNECTION', getenv('MYSQL_DSN'));
define('DBUSER', getenv('MYSQL_USER'));
define('DBPASS', getenv('MYSQL_PASSWORD'));
?>
