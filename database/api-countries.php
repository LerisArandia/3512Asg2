<?php 


require_once 'helper-functions.inc.php';


header('Content-Type: application/json');

if(isset($_GET['iso'])){
    $iso = $_GET['iso'];
    $country = getACountry(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS), $iso);
}
else if(isset($_GET['images'])){
    $country = getCountriesWithImages(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS));
}
else{
    $country = getAllCountries(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS));
}

echo json_encode($country, JSON_PRETTY_PRINT+JSON_NUMERIC_CHECK);


?>
