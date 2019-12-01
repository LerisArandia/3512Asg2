<?php 

require_once 'config.inc.php';
require_once 'db-functions.inc.php'; 
require_once 'helper-functions.inc.php';


header('Content-Type: application/json');


if(isset($_GET['iso'])){
    $iso = $_GET['iso'];
    $country = getACountry(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS), $iso);
    
}
else{
    $country = getAllCountries(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));
}

echo $country;

?>
