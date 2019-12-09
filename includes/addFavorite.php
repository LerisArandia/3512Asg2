<?php
/**********Adding to Favorites**********/
if(isset($_POST['single'])){
    session_start();
}

$message = '';
$ok = true;

if(isset($_POST["favorite"])){
    unset($_POST['favorite']);
    if(isset($_SESSION['email'])){
        if(!in_array($_POST['id'], $_SESSION['favorite'])){
            $_SESSION['favorite'][] = $_POST['id'];
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

if(isset($_POST['single'])){
    echo json_encode(
        array(
            'ok' => $ok,
            'message' => $message
        )
    );
}
?>