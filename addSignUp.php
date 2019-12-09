
<?php
session_start();
require_once 'database/helper-functions.inc.php';
// require_once 'users.php';
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


    if ($password != $confirmPW) {
        header("Location: signUp.php");
        $_SESSION["invalid"] = "The passwords do not match. Please re-enter.";
        exit();
        // header("Location: signUp.php?pw=bad");
    } else {

        //check if password is not 8 characters long
        if (strlen($password) < 8) {
            header("Location: signUp.php");
            $_SESSION["invalid"] = "Password does not 8  contain characters. Please re-enter a new one.";
        } else {
            echo "passwords match";
            // header("Location: signUp.php?pw=good");

            $pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
            $sql = "SELECT * FROM users WHERE Email='" . $email . "'"; 
            $result = $pdo->query($sql);
            $statement =  $result->fetch();
            // run query didnt work because of "fetchAll" because it doesnt fetch anything from db

            // if email is not in the db already
            if ($statement == null) {
                $lastUserID = getLastUserID($pdo);
                //increment last user id by 1 for new user
                foreach ($lastUserID as $id){
                    $newUserID = $id['UserID'] + 1;
                }
                //hashes the password using md5 with generated salt
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

                //THERES AN ERROR
                // inserts users  into the users table
                $sqlInsert = "INSERT INTO users (UserID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email, Privacy) VALUES ('$newUserID', '$firstName', '$lastName', null, '$city', null, '$country', null, null, '$email', null)";

                // insert users log in info to userslogin table
                $sqlLoginInsert = "INSERT INTO userslogin (UserID, UserName, Password, Salt, Password_sha256, State, DateJoined, DateLastModified) VALUES ('$newUserID', '$email', '$hashedPassword', null, null, null, null, null)";

                $pdo->exec($sqlInsert);
                $pdo->exec($sqlLoginInsert);

                 //log user in when registration is successful
                $checkUser = getUser($pdo, $email);
                $checkLogin =  getUserLogin($pdo, $email);
                if ($checkUser && $checkLogin) {

                    header("Location: index-loggedin.php");
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
                header("Location: signUp.php?error=email");
                $_SESSION["invalid"] = "The email you entered is already taken. Please try a different one.";
                exit();
            }
        }
    }
} else {
    //just in case user somehow gets to addSignUp.php without pressing submit button
    header("Location: signUp.php?error=submit");
    $_SESSION["invalid"];
}



?>