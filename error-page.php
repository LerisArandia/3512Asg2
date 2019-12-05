<!DOCTYPE html>
<html>
<head>
    <?php 
        $title = "Error: Page Not Found";
        include "includes/head.php";
    ?>
    <link rel="stylesheet" href="css/error.css">
</head>

<body>

<img id="brokenImage" src="images/broken.png"/>
<h2>You found the Page Not Found Page.</h2>
<p>Let's get you back on track!</p>

<div id="header">
    <!-- insert logo here -->
    <!--For Media Query Nav-->
    <div id="burger">&#9776;</div>
    <ul id="navigation">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="browse.php">Browse/Search</a></li>
        <li><a href="single-country.php">Countries</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="signUp.php">Sign Up</a></li>
        <img src="images/logo.png" id="logo">
    </ul>
</div>


</body>







</html>