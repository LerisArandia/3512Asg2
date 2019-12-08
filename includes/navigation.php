<div id="header">
    <!--For Media Query Nav-->
    <div id="burger">&#9776;</div>
    <?php if (isset($_SESSION["email"])) { ?>
        <div id="logo"><a href="index-loggedin.php"><img id="logo" src="../images/logo.png"></a></div>
            <ul id="navigation">
                <li><a href="index-loggedin.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="browse.php">Browse/Search</a></li>
                <li><a href="single-country.php">Countries</a></li>
                <li><a href="favorites.php">Favorites</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="includes/logout.php">Logout</a></li>
            </ul>
    <?php }else{ ?>
        <div id="logo"><a href="index.php"><img id="logo" src="../images/logo.png"></a></div>
            <ul id="navigation">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="browse.php">Browse/Search</a></li>
                <li><a href="single-country.php">Countries</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="signUp.php">Sign Up</a></li>
            </ul>
    <?php } ?>
</div>