<!-- API for ImagesDetail Database table -->
<?php 

require_once 'config.inc.php';
require_once 'db-functions.inc.php'; 
require_once 'helper-functions.inc.php';

header('Content-Type: application/json');

if(isset($_GET['id'])){ // --------------------- get a single image -------------------------- //
    $id = $_GET['id']; // image id
    $image = getSingleImage(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS), $id);
}
else{ // ------------------------ get all images ----------------------- //
    $image = getAllImages(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS));
}

echo json_encode($image, JSON_PRETTY_PRINT+JSON_NUMERIC_CHECK);

?>