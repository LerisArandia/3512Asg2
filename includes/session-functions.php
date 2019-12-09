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
                
                $userFavsLabel = $username . "favorite";

                //if (isset($_COOKIE[$username])) {
                    //$_SESSION['email'] = $_COOKIE[$username];
                //} else {
                    //setCookie($username, $username);
                $_SESSION['email'] = $username;
                //}
                //if (isset($_COOKIE[$userFavsLabel]) && $_COOKIE[$userFavsLabel]) {
                    //$_SESSION['favorite'] = unserialize($_COOKIE[$userFavsLabel]);
                //} else {
                    //setCookie($userFavsLabel, serialize(array()));
                //$_SESSION['favorite'] = array();
                //}
                // if(isset($_COOKIE[$username['email']]) && isset($_COOKIE[$username['favorite']])  ){
                //     $_SESSION['email'] = $_COOKIE[$username]['email'];
                //     $_SESSION['favorite'] = unserialize($_COOKIE['$_SESSION[email][favorite]']);
                // }
                // else{
                //     $_SESSION['email'] = $username;
                //     $_SESSION['favorite'] = array();
                // }
                // assigns to session
                
                // $_SESSION['id'] = $user['UserID']; 
                // setCookie('$_SESSION[email][email]', $_SESSION['email']);
                // setCookie('$_SESSION[email][favorite]', $_SESSION['favorite']);
                return true;
            }
            else{
                return false;
            }
        }
        return false;
    }

    public function verify_session(){
        if(isset($_SESSION['email'])){
            $username = $_SESSION['email'];
            $user = $this->usernameExists($_SESSION['email']);

            if ( false != $user){
                $this->user = $user;
                return true;
            }

        }
        return false;
    }

    private function usernameExists($username){
        $pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
        $result = getUserInfo($pdo, $username);

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