<?php
/**********Removing from Favorites**********/
if(isset($_POST["remove"])){
    unset($_POST['remove']);
    if(isset($_SESSION['email'])){
        if(in_array($_POST['removeID'], $_SESSION['favorite'])){
            $key = array_search($_POST['removeID'],$_SESSION['favorite']);
            if($key!==false){
                unset($_SESSION['favorite'][$key]);
                $_SESSION['favorite'] = array_values($_SESSION['favorite']);
                unset($_POST['removeID']);
                var_dump($_SESSION);
                
            }
        }
    }
}
?>