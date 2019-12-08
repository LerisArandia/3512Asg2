<?php
/**********Adding to Favorites**********/
if(isset($_POST["favorite"])){
    unset($_POST['favorite']);
    if(isset($_SESSION['email'])){
        if(!in_array($_POST['saveID'], $_SESSION['favorite'])){
            $_SESSION['favorite'][] = $_POST['saveID'];
            unset($_POST['saveID']);
            // var_dump($_SESSION);
        }
    }else{
        unset($_POST['fav']);
        header("Location: login.php"); 
    }
}
?>