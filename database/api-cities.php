<?php 

require_once 'config.inc.php';
require_once 'db-functions.inc.php'; 
require_once 'helper-functions.inc.php';

header('Content-Type: application/json');


if(isset($_GET['city'])){
    $citycode = $_GET['city'];
    $city = getACity(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS), $citycode);
}
else if(isset($_GET['iso'])){
    $countryISO = $_GET['iso'];
    $city = getAllCitiesInCountry(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS), $countryISO);
}
else{
    $city = getAllCities(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS));
}

echo json_encode($city, JSON_PRETTY_PRINT+JSON_NUMERIC_CHECK);

?>