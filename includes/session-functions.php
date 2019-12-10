
<!-------------------- FUNCTIONS THAT HELP WITH LOGIN AND STARTING USER SESSIONS ------------------>

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
        if ( false != $user){ // if username exists

            $matching = $this->checkPassword($password, $user['Password'], $user['Salt']);
            if($matching == true){ // matching passwords  
                $_SESSION['email'] = $username; //
                return true;
            }
            else{ // if password doesnt exist
                return false;
            }
        }
        // returns false if username doesnt exist
        return false;
    }

    public function verify_session(){
        if(isset($_SESSION['email'])){

            $username = $_SESSION['email'];

            // checks for existing user
            $user = $this->usernameExists($_SESSION['email']);
            if ( false != $user){
                $this->user = $user;
                return true;
            }
        }
        return false;
    }

    // compares username to users in database
    private function usernameExists($username){
        $pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
        $result = getUserInfo($pdo, $username);


        $pdo=null;
        // returns false if user isn't found, true if user exists
        return $result;
    }

    // comapares entered password to encrypted password in database 
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