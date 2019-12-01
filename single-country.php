<?php

require_once 'helper-functions.inc.php';

if(isset($_GET['countryiso'])){
    $iso = $_GET['countryiso'];
    $result = getACountry(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS), $iso);
}
else{
    $country = getAllCountries(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));
}

function displayCountryDetails(){
    echo $country;
}

?>
<html>

<head>
    <meta charset="utf-8">
    <title>Country Page</title>

    <link rel="stylesheet" href="css/template.css">
    <link rel="stylesheet" href="css/single-country.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
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
                <form id="filters">
                    <input type="text" placeholder="Search For Country">
                    <select id="continent"><option value="">Search By Continent</option></select>
                    <div><input type="checkbox" id="imageCountryOnly" name="imageCountry">Countries With Images Only</div>
                    <button class="clearFilter" id="clearCountry">Clear All Country Filters</button>
                </form>
            </div>

            <div id="countryList">
            </div>


            <div id="mainContent">
                <div id="countryDetails"><?php displayCountryDetails(); ?></div>
                <div id="cityList">City List</div>
                <div id="countryPhotos">Country Photos</div>
            </div>
        </div>
    </main>
</body>
<script src="js/template.js"></script>
<script src="js/single-country.js"></script>
</html>