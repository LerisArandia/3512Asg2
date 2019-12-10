<?php
/***
 * This file is used by signUp.php. It checks the users input and if the new users email does not already
 * exist in the db. When registration is successful, add user to users table and their login info to userslogin table
 */
session_start();
require_once 'database/helper-functions.inc.php';
if (isset($_POST['submit'])) {
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPW = $_POST['confirm'];

    //save form data when registration fails
    $_SESSION["firstName"] = $firstName;
    $_SESSION["lastName"] = $lastName;
    $_SESSION["country"] = $country;
    $_SESSION["city"] = $city;

    //check for  matching passwords
    if ($password != $confirmPW) {
        $_SESSION["invalid"] = "The passwords do not match. Please re-enter.";
        header("Location: signUp.php?error=pwMatch");

        exit();
    } else {
        //check if password is not 8 characters long
        if (strlen($password) < 8) {
            $_SESSION["invalid"] = "Password does not 8  contain characters. Please re-enter a new one.";
            header("Location: signUp.php?error=pwLength");
            exit();
        } else {
            $pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
            $sql = "SELECT * FROM users WHERE Email='" . $email . "'";
            $result = $pdo->query($sql);
            $statement =  $result->fetch();
            // run query didnt work because of "fetchAll" because it doesnt fetch anything from db

            // if email is not in the db already
            if ($statement == null) {
                $lastUserID = getLastUserID($pdo);
                //increment last user id by 1 for new user
                foreach ($lastUserID as $id) {
                    $newUserID = $id['UserID'] + 1;
                }
                //hashes the password using md5 with generated salt
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

                // inserts users  into the users table
                $sqlInsert = "INSERT INTO users (UserID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email, Privacy) VALUES ('$newUserID', '$firstName', '$lastName', null, '$city', null, '$country', null, null, '$email', null)";

                // insert users login info to userslogin table
                $sqlLoginInsert = "INSERT INTO userslogin (UserID, UserName, Password, Salt, Password_sha256, State, DateJoined, DateLastModified) VALUES ('$newUserID', '$email', '$hashedPassword', null, null, null, null, null)";

                $pdo->exec($sqlInsert);
                $pdo->exec($sqlLoginInsert);

                //log user in when registration is successful
                $checkUser = getUser($pdo, $email);
                $checkLogin =  getUserLogin($pdo, $email);
                if ($checkUser && $checkLogin) {
                    $pdo = null;
                    $_SESSION['email'] = $email;
                    header("Location: index.php");

                    exit();
                } else {
                    $pdo = null;
                    //just in case something went wrong with db
                    $_SESSION["invalid"] = "There's an unknown error in the registration. Please try again.";
                    header("Location: signUp.php?error=unknown");
                    exit();
                }
            } else {
                // email already exist in db
                $_SESSION["invalid"] = "The email you entered is already taken. Please try a different one.";
                header("Location: signUp.php?error=email");
                exit();
            }
        }
    }
} else {
    //just in case user somehow gets to addSignUp.php without pressing submit button
    $_SESSION["invalid"];
    header("Location: signUp.php?error=submit");

    exit();
}
?>