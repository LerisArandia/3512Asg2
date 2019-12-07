<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <?php 
        $title = "Home - Logged in";
        include "includes/head.php";
    ?>
    <link rel="stylesheet" href="css/index-loggedin.css">
</head>

<body>
    <main class="container">
    <?php include "includes/navigation.php" ; ?>
        <div class="main " id="main-loggedin">
            <div id="userInfo">
                user info
            </div>
            <div id="favoritedImages">Favorited Images</div>
            <div id="search">search</div>
            <div id="images">images</div>
        </div>
    </main>
</body>
<script src="js/template.js"></script>
</html>