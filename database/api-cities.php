<!-- API for cities (and images) database table -->
<?php 
require_once 'config.inc.php';
require_once 'db-functions.inc.php'; 
require_once 'helper-functions.inc.php';

header('Content-Type: application/json');


if(isset($_GET['city'])){ // ------------------------- get a single city ------------------------------- //
    $citycode = $_GET['city']; // city citycode
    $city = getACity(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS), $citycode);
}
else if(isset($_GET['iso'])){ // ------------------------- get all cities in a country ------------------------------- //
    $countryISO = $_GET['iso']; // country iso
    $city = getAllCitiesInCountry(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS), $countryISO);
}
else{ // ------------------------- get all cities ------------------------------- //
    $city = getAllCities(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS));
}

echo json_encode($city, JSON_PRETTY_PRINT+JSON_NUMERIC_CHECK);

?>