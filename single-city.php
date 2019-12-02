<html>

<head>
    <?php 
        $title = "City Page";
        include "includes/head.php";
    ?>
    <link rel="stylesheet" href="css/single-city.css"> <!-- has the same formatting as single country -->
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
        <div class="main" id="main-cityPage">
            <div id="cityFilters">City Filters</div>
            <div id="cityList">City List</div>
            <div id="mainContent">
                <div id="cityDetails">City Details</div>
                <div id="cityMap">City Map</div>
                <div id="cityPhotos">City Photos</div>
            </div>
        </div>

    </main>
</body>
<script src="js/template.js"></script>
</html>