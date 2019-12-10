<?php session_start(); ?>
<!-- 
    Page is "accessed" when a city is not passed to single city
    Image id is not passed to single photo
    Image id that is passed to single photo
 -->
<!DOCTYPE html>
<html>
<head>
    <?php 
        $title = "Error: Page Not Found";
        include "includes/head.php";
    ?>
    <link rel="stylesheet" href="css/template.css">
    <link rel="stylesheet" href="css/error.css">
</head>

<body>
    <img id="brokenImage" src="images/broken.png"/>
    <h2>You found the Page Not Found Page.</h2>
    <p>Let's get you back on track!</p>
    <?php include "includes/navigation.php" ?>
</body>
<script src="js/template.js"></script>

</html>