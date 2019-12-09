<?php
if(!isset($_SESSION['email'])){
    session_start();
}
/**********Removing from Favorites**********/
$message = '';

if(isset($_POST["remove"])){
    unset($_POST['remove']);
    if(isset($_SESSION['email'])){
        if(in_array($_POST['id'], $_SESSION['favorite'])){
            $key = array_search($_POST['id'],$_SESSION['favorite']);
            if($key!==false){
                unset($_SESSION['favorite'][$key]);
                $_SESSION['favorite'] = array_values($_SESSION['favorite']);
                unset($_POST['id']);
                //var_dump($_SESSION);
                $message = "Removed from Favorites!";
                $ok = 'remove';
            }
        }
    }
}
if (isset($_POST['single'])) {
    echo json_encode(
        array(
            'ok' => $ok,
            'message' => $message
        )
    );
}
?>