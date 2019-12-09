<?php
    session_start();
    if(isset($_SESSION['email'])){

        $email = $_SESSION['email'];
        $favArray = $_SESSION['favorite'];



        setCookie('$_SESSION[email][email]', $_SESSION['email']);
        setCookie('$_SESSION[email][favorite]', serialize($favArray));


        session_unset();
        session_destroy();
        header("Location:../index.php");
        exit();
    }
?>