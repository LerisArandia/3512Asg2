<!DOCTYPE html>
<html>
    <head>
        <?php 
            $title = "Sign Up";
            include "includes/head.php";
        ?>
        <link rel="stylesheet" href="css/signUp.css">
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
            <h2>Create an Account</h2>
            <div id="register">
                <form id="registerForm" action="php" method="post"> 
                    <input type="text" placeholder="First Name" name="fName">
                    <input type="text" placeholder="Last Name" name="lName">
                    <input type="text" placeholder="City" name="city">
                    <input type="text" placeholder="Country" name="country">
                    <input type="text" placeholder="Email" name="email">
                    <input type="text" placeholder="Password" name="password">
                    <input type="text" placeholder="Confirm Password" name="confirm">
                    <button id="signUp" type="submit">Sign Up</button>
                </form>

            </div>

        </div>
    </main>

</body>
<script src="js/template.js"></script>
</html>