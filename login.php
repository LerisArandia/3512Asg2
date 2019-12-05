<?php
    include('database/config.inc.php');
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){

    }
?>
<!DOCTYPE html>
<html>
<head>
    <?php 
        $title = "Login";
        include "includes/head.php";
    ?>
    <link rel="stylesheet" href="css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
</head>

<body>
    <main class="container">
    <?php include "includes/navigation.php" ; ?>
        <div class="main">
            <div id="content">
                <h2>LOGIN</h2>
                <input type="text" id="email" placeholder="Email" name="email" required>
                <input type="password" id="password" placeholder="Password" name="password" required>
                <button type=button id="cancel">CANCEL</button>
                <button type=button id="login">LOGIN</button>
            </div>
        </div>
    </main>
<script src="js/template.js"></script>
<script src="js/login.js"></script>
</html>