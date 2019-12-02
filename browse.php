<!DOCTYPE html>
<html>
<head>
<?php 
        $title = "Search & Browse";
        include "includes/head.php";
    ?>
    <link rel="stylesheet" href="css/browse.css">
</head>

<body>
    <main class="container">
        <div id="header">
            <!-- insert logo here -->
            <!--For Media Query Nav-->
            <div id="hamburger-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul id="navigation">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="browse.php">Browse/Search</a></li>
                <li><a href="single-country.php">Countries</a></li>
                <li><a href="single-city.php">Cities</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="signUp.php">Sign Up</a></li>
            </ul>
        </div>
        <div class="main">
            <div id="photoFilter">Photo Filter</div>
            <div id="results">Browse/Search Results</div>
        </div>
    </main>

</html> 