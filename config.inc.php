<?php
define('DBHOST', 'localhost');
define('DBNAME', 'travel');
define('DBUSER', getenv('root'));
define('DBPASS', '');
define('DBCONNSTRING',"mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8mb4;");
?>