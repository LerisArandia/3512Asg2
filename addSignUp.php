<!-- CLEAN UP CODE, ADD VERIFICATION, AND ADD TO USERS LOGIN TABLE !!!  -->

<?php
session_start();
require_once 'database/helper-functions.inc.php';
// require_once 'users.php';
if (isset($_POST['submit'])) {
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPW = $_POST['confirm'];

    echo $firstName . "<br>";
    echo $lastName . "<br>";
    echo $city . "<br>";
    echo $country . "<br>";
    echo $email . "<br>";
    echo $password . "<br>";
    echo $confirmPW . "<br>";

    if ($password != $confirmPW) {
        echo "passwords dont match";
        // header("Location: signUp.php?pw=bad");
    } else {
        echo "passwords match";
        // header("Location: signUp.php?pw=good");

        $pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
        $sql = "SELECT * FROM users WHERE Email=?";
        $statement = runQuery($pdo, $sql, array($email));
        
        if (count($statement)==0) {
            
            //hashes the password using md5 with generated salt
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

            //THERES AN ERROR
            // inserts users  into the users table
            $sqlInsert = "INSERT INTO users (UserID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email, Privacy) VALUES (? , ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            // insert users log in info to userslogin table
            $sqlLoginInsert = "INSERT INTO userslogin (UserID, UserName, Password, Salt, Password_sha256,State, DateJoined, DateLastModified,) VALUES (?, ?, ?, ?, ?, ?, ? , ?)";


            // INCREMENT USERID AND ADD LOGIN INFO IN USERSLOGIN TABLE
            $parameters1 = array(61, $firstName, $lastName, null, $city, null, $country, null, null, $email, null);
            $parameters2 = array(61, $email, $hashedPassword, null, null, null, null, null);

             $smt1 = runQuery($pdo, $sqlInsert, $parameters1);
            $smt2 = runQuery($pdo, $sqlLoginInsert, $parameters2);

            //$userData = getSingleUser($email);

            echo "hello";
        } else {
            echo "false";
        }
    }
} else {
    header("Location: signUp.php?nothing=working");;
}



?>