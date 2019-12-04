<?php 

require_once 'config.inc.php';
require_once 'db-functions.inc.php'; 
require_once 'helper-functions.inc.php';

header('Content-Type: application/json');


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $image = getSingleImage(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS), $id);
}
else{
    $image = getAllImages(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS));
}

echo json_encode($image, JSON_PRETTY_PRINT+JSON_NUMERIC_CHECK);

?>