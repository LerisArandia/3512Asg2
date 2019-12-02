<!DOCTYPE html>
<html>
<head>
    <?php 
        $title = "Profile";
        include "includes/head.php";
    ?>
    <link rel="stylesheet" href="css/profile.css">
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
            <div id="userInfo">
                <img src="images/anon.png" id="profilePicture" alt="profile picture">
                <div id="userDescription">
                    <p><strong>John Doe</strong></p>
                    <p>Calgary, Canada </p>
                    <p>Bio: </p>
                    <p>Interests: </p>
                </div>
            </div>
            <div id="personalPhotos">
                Personal Photos (Photos they've uploaded)
            </div>
        </div>
    </main>
</body>


<script src="js/template.js"></script>
</html>