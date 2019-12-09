<?php
    session_start();
    if(isset($_SESSION['email'])){

        $email = $_SESSION['email'];
        $favArray = $_SESSION['favorite'];
        $favName = $email . "favorite";


        setCookie($email, $email);
        setCookie($favName, serialize($favArray));


        session_unset();
        session_destroy();
        header("Location:../index.php");
        exit();
    }
?>