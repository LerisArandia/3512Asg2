<?php
define('DBHOST', 'localhost');
define('DBNAME', 'travel');
define('DBUSER', getenv('JAWSDB_URL'));
define('DBPASS', '');
define('DBCONNSTRING',"mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8mb4;");
?>