<?php 

require_once 'config.inc.php';
require_once 'db-functions.inc.php'; 
require_once 'helper-functions.inc.php';

header('Content-Type: application/json');


if(isset($_GET['city'])){
    $citycode = $_GET['city'];
    $city = getACity(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS), $citycode);
    
}
else{
    $city = getAllCities(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));
}

echo $city;

?>