<?php
// set error reporting on to help with debugging
error_reporting(E_ALL);
ini_set('display_errors','1');

// you may need to change these for your own environment
define('DBCONNECTION', getenv('MYSQL_DSN'));
define('DBUSER', getenv('MYSQL_USER'));
define('DBPASS', getenv('MYSQL_PASSWORD'));

//https://comp-3512-asg-2-2019.appspot.com
?>
