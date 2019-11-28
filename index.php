<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    
    <link rel="stylesheet" href="css/template.css">
    <link rel="stylesheet" href="css/index.css">
    
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
                <!-- <li><a href="api-cities.php">CITIES API</a></li> -->
                <li><a href="api-countries.php">COUNTRIES API</a></li>
            </ul>
        </div>
        <div class="main">
            <!-- <div id="buttons"> -->
                <button type=button id="login">LOGIN</button>
                <button type=button id="join">JOIN</button>
            <!-- </div> -->
            <input type="search" name="searchPhotos" placeholder="SEARCH BOX FOR PHOTOS">
        </div>
    </main>
</body>
<script src="js/template.js"></script>
</html>