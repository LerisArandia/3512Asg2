<?php
/**********Adding to Favorites**********/
if(isset($_POST["favorite"])){
    unset($_POST['favorite']);
    if(isset($_SESSION['email'])){
        if(!in_array($_POST['id'], $_SESSION['favorite'])){
            $_SESSION['favorite'][] = $_POST['id'];
            unset($_POST['id']);
            //var_dump($_SESSION);
        }
    }else{
        unset($_POST['fav']);
        header("Location: login.php"); 
    }
}
?>