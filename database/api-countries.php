<?php
/***
 * API for countries (and images) database table
 */
require_once 'helper-functions.inc.php';
header('Content-Type: application/json');

if(isset($_GET['iso'])){ // ------------------------- get a single country ------------------------------- //
    $iso = $_GET['iso']; // country iso
    $country = getACountry(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS), $iso);
}
else if(isset($_GET['images'])){ // ------------------------ get countries that have images ----------------------- //
    $country = getCountriesWithImages(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS));
}
else{ // ------------------------- get all countries ---------------------- //
    $country = getAllCountries(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS));
}

echo json_encode($country, JSON_PRETTY_PRINT+JSON_NUMERIC_CHECK);
?>
