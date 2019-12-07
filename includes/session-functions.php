<?php 
session_start();
require_once 'database/helper-functions.inc.php';

class Login{

    public $user;

    public function _construct(){
        global $users;
    }

    public function verify_login($username, $password){

        // finds username in "database"
        $user = $this->usernameExists($username);

        if ( false != $user){
            $matching = $this->checkPassword($password, $user['Password'], $user['Salt']);
            if($matching == true){ // matching passwords

                // STARTS SESSION
                $_SESSION['email'] = $username;
                $_SESSION['id'] = $user['UserID'];
                //echo "<p>Passwords match</p>";
                return true;
            }
            else{
                //echo "<p>Passwords don't match</p>";
                return false;
            }
        }
        return false;
    }

    public function verify_session(){
        $username = $_SESSION['email'];
        
        $user = $this->usernameExists($_SESSION['email']);

        if ( false != $user){
            $this->user = $user;
            return true;
        }

        return false;
    }

    private function usernameExists($username){
        $pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
        $result = getUserInfo($pdo, $username);

        // if ($result != false) {
        //     echo "<p>I found something</p>";
        // } else {
        //     echo "<p>I FOUND NOTHING</p>";
        // }

        return $result;
        $pdo=null;
    }

    private function checkPassword($enteredPassword, $dbPassword, $salt){
        $digest = password_hash( $enteredPassword, PASSWORD_BCRYPT, ['cost' => 12] );
        if (password_verify($enteredPassword, $dbPassword)) {
            return true;
        }
        else{
            return false;
        }
        
    }


}

// instantiates new class
$login = new Login;



?>