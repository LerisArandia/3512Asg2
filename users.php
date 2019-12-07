
<!--  not used -->
<?php 

require_once 'database/helper-functions.inc.php';

// needed for javascript clients from another domain
header("Access-Control-Allow-Origin: *");

$connection = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);

function getAllUsers($connection){
try{
    $sql = "SELECT UserID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email, Privacy FROM users";
    $statement = $connection -> prepare($sql);
    $statement -> execute();
    
    $result = $statement -> fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result, JSON_PRETTY_PRINT);
    return $result;
    $pdo = null;
    
}catch(PDOExeption $e){
    die($e->getMessage());
}
}

//Retrieves only the single user 
function getSingleUser(){
    try{
        $sql = "SELECT UserID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email, Privacy FROM users WHERE last=?";
        $connection = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
        $statement = $connection -> prepare($sql);
        $statement -> bindValue(1, $_GET['last']);
        $statement -> execute();
        while ($row = $statement -> fetch(PDO::FETCH_ASSOC)) {
          $result = json_encode($row, JSON_PRETTY_PRINT);
        }
        return $result;
        $connection = null;
        
    }catch(PDOExeption $e){
        die($e->getMessage());
    }
}


?>
