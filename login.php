<!DOCTYPE html>
<html>
<head>
    <?php 
        $title = "Login";
        include "includes/head.php";
    ?>
    <link rel="stylesheet" href="css/login.css">
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
            <input type="text" id="email" placeholder="Enter Email" name="email" required>
            <input type="text" id="password" placeholder="Enter Password" name="password" required>
            <button type=button id="login">LOGIN</button>
            <button type=button id="signup">SIGN UP</button>
        </div>
    </main>
<script src="js/template.js"></script>
</html>