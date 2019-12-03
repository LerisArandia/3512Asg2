<?php 


require_once 'helper-functions.inc.php';


header('Content-Type: application/json');

if(isset($_GET['iso'])){
    $iso = $_GET['iso'];
    $country = getACountry(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS), $iso);
}
else{
    $country = getAllCountries(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));
}

echo json_encode($country, JSON_PRETTY_PRINT+JSON_NUMERIC_CHECK);;


?>
git