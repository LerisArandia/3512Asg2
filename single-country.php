<?php

require_once 'config.inc.php';
require_once 'db-functions.inc.php'; 
require_once 'helper-functions.inc.php';

function outputCountries(){
    try{
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $allCountries = getAllCountries();
        foreach( $allCountries as $country){
            echo '<a href="single-country.php?iso='.$country['ISO'].'">'.$country['CountryName'].'</a>';
        }
    }
    catch (PDOException $e){
        die( $e->getMessage());
    }

}


?>
<html>

<head>
    <meta charset="utf-8">
    <title>Country Page</title>

    <link rel="stylesheet" href="css/template.css">
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
                <li><a href="">Home</a></li>
                <li><a href="">About</a></li>
                <li><a href="">Browse/Search</a></li>
                <li><a href="">Countries</a></li>
                <li><a href="">Cities</a></li>
                <li><a href="">Login</a></li>
                <li><a href="">Sign Up</a></li>
            </ul>
        </div>
        <div class="main" id="main-countryPage">
            <div id="countryFilters">
                <form class="form" method="get" action="<?=$_SERVER['REQUEST_URI']?>">
                    <label>Countries</label>
                       <?php outputCountries(); ?>
                    <button class="small ui orange button" type="submit">
                        <i class="filter icon"></i> Select 
                    </button>  
                </form>
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