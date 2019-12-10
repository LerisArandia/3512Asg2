<?php
/**********Removing from Favorites**********/
// If Removing from Favorites from Single Page start session 
if(isset($_POST['single'])){
    session_start();
}
$message = '';

if(isset($_POST["remove"])){
    unset($_POST['remove']);
    //Checks for session
    if(isset($_SESSION['email'])){
        //Checks if favorite exisits in array
        if(in_array($_POST['id'], $_SESSION['favorite'])){
            //Finds key for photo
            $key = array_search($_POST['id'],$_SESSION['favorite']);
            //Removes photo from favorites array
            if($key==true){
                unset($_SESSION['favorite'][$key]);
                $_SESSION['favorite'] = array_values($_SESSION['favorite']);
                unset($_POST['id']);
                $message = "Removed from Favorites!";
                $ok = 'remove';
            }
        }
    }
}

/***If removing from Favorites from Single Page, sends back JSON array***/
if (isset($_POST['single'])) {
    echo json_encode(
        array(
            'ok' => $ok,
            'message' => $message
        )
    );
    unset($_POST['single']);
}
?>