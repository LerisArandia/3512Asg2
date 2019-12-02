<?php

?>
<html>

<head>
    <?php 
        $title = "Country Page";
        include "includes/head.php";
    ?>
    <link rel="stylesheet" href="css/single-country.css">
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
        <div class="main" id="main-countryPage">
            <div id="countryFilters">
                <!-- <form class="form" method="get" action="<?=$_SERVER['REQUEST_URI']?>">
                    <label>Countries</label>
                       

                    <button class="small ui orange button" type="submit">
                        <i class="filter icon"></i> Select 
                    </button>  
                </form> -->
            </div>

            <div id="countryList">Country List</div>
            <div id="mainContent">
                <div id="countryDetails">Country Details</div>
                <div id="cityList">City List</div>
                <div id="countryPhotos">Country Photos</div>
            </div>
        </div>
    </main>
</body>
<script src="js/template.js"></script>
</html>