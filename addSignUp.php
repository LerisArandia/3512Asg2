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
        header("Location: signUp.php");
        $_SESSION["invalid"] = "The passwords do not match. Please re-enter.";
        exit();
        // header("Location: signUp.php?pw=bad");
    } else {


        if (strlen($password) < 8) {
            header("Location: signUp.php");
            $_SESSION["invalid"] = "Password does not 8  contain characters. Please re-enter a new one.";
        } else {
            echo "passwords match";
            // header("Location: signUp.php?pw=good");

            $pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
            $sql = "SELECT * FROM users WHERE Email='" . $email . "'"; // had to put quotations around $email bc @ escapes it
            $result = $pdo->query($sql);
            $statement =  $result->fetch();
            // $statement = runQuery($pdo, $sql, array($email));
            // run query didnt work because of "fetchAll" because it doesnt fetch anything from db

            // if email is not in the db already
            if ($statement == null) {
                $lastUserID = getLastUserID($pdo);
                // echo $lastUserID['UserID'];
                
                foreach ($lastUserID as $id){
                    
                    $newUserID = $id['UserID'] + 1;
                }
                // echo $lastUserID;
                // echo $lastUserID['UserID'];
                // $newUserID = $lastUserID + 1;
                //hashes the password using md5 with generated salt
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

                //THERES AN ERROR
                // inserts users  into the users table
                $sqlInsert = "INSERT INTO users (UserID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email, Privacy) VALUES ('$newUserID', '$firstName', '$lastName', null, '$city', null, '$country', null, null, '$email', null)";

                // insert users log in info to userslogin table
                $sqlLoginInsert = "INSERT INTO userslogin (UserID, UserName, Password, Salt, Password_sha256, State, DateJoined, DateLastModified) VALUES ('$newUserID', '$email', '$hashedPassword', null, null, null, null, null)";

                // INCREMENT USERID AND ADD LOGIN INFO IN USERSLOGIN TABLE
                // $parameters1 = array(60, $firstName, $lastName, null, $city, null, $country, null, null, $email, null);
                // $parameters2 = array(60, $email, $hashedPassword, null, null, null, null, null);


                $pdo->exec($sqlInsert);
                $pdo->exec($sqlLoginInsert);


                // $smt1 = runQuery($pdo, $sqlInsert, $parameters1);
                // $smt2 = runQuery($pdo, $sqlLoginInsert, $parameters2);

                //$userData = getSingleUser($email);

                $checkUser = getUser($pdo, $email);
                $checkLogin =  getUserLogin($pdo, $email);
                echo "user added";
                //log user in when registration is successful
                if ($checkUser && $checkLogin) {

                    header("Location: index.php");
                    $_SESSION['email'] = $email;
                    // unset($_SESSION["email"]);
                    exit();
                } else {
                    //just in case something went wrong with db
                    header("Location: signUp.php");
                    $_SESSION["invalid"] = "There's an unknown error in the registration. Please try again.";
                }
            } else {
                //another user used that existing email
                header("Location: signUp.php?email=error");
                $_SESSION["invalid"] = "The email you entered is already taken. Please try a different one.";
                exit();
            }
        }
    }
} else {
    header("Location: signUp.php?nothing=working");;
}



?>