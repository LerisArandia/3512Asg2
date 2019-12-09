<?php
/********************Adding to Favorites********************/
/***If adding to Favorites from Single Page***/
if(isset($_POST['single'])){
    session_start();
}
/***If favorites session variable does not exist, make an array***/
if(!isset($_SESSION['favorite'])){
    $favorites = array();
}else{
    $favorites = $_SESSION['favorite'];
}

$message = '';
$ok = true;

if(isset($_POST["favorite"])){
    unset($_POST['favorite']);
    if(isset($_SESSION['email'])){
        if(!in_array($_POST['id'], $favorites)){
            $favorites[] = $_POST['id'];
            $_SESSION['favorite'] = $favorites;
            unset($_POST['id']);
            //var_dump($_SESSION);
            $message = "Added to Favorites!";
            $ok = 'favorite';
        }
    }else{
        unset($_POST['fav']);
        $message = "login.php";
        $ok = 'login';
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
}
?>