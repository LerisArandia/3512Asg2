<?php
/******************** Adding to Favorites Array ********************/
/*** If adding to Favorites from Single Page start session ***/
if(isset($_POST['single'])){
    session_start();
}
/*** If favorites session variable does not exist, make an array ***/
if(!isset($_SESSION['favorite'])){
    $favorites = array();
}else{
    $favorites = $_SESSION['favorite'];
}

$message = '';
$ok = '';

if(isset($_POST["favorite"])){
    unset($_POST['favorite']);
    //Checks for session
    if(isset($_SESSION['email'])){
        //Checks if photo exists in favorites already
        if(!in_array($_POST['id'], $favorites)){
            //Add to favorites array
            $favorites[] = $_POST['id'];
            $_SESSION['favorite'] = $favorites;
            unset($_POST['id']);
            $message = "Added to Favorites!";
            $ok = 'favorite';
        }
    }else{ //If not logged in (no session)
        unset($_POST['fav']);
        $message = "login.php";
        $ok = 'login';

        //If  not adding to Favorites from Single Page, direct to login.php
        if(!isset($_POST['single'])){
            header('Location: login.php');
        }
    }
}

/***If adding to Favorites from Single Page, sends back JSON array***/
if(isset($_POST['single'])){
    echo json_encode(
        array(
            'ok' => $ok,
            'message' => $message
        )
    );
    unset($_POST['single']);
}
?>