<?php
session_start();
require_once 'database/helper-functions.inc.php';

function generateCityDetails($city){
    echo "<h3>{$city['AsciiName']}</h3>";
    echo "<div id='cityPopulation'>Population: ".number_format($city['Population'])." residents</div>";
    echo "<div id='cityElevation'>Elevation: {$city['Elevation']}</div>";
    echo "<div id='cityTimeZone'>Time Zone: {$city['TimeZone']}</div>";
}

function generateContinentsCityPage(){
    echo "<select name='continentCityPage' id='continentCityPage' placeholder='Search By Continent'>";
    echo "<option value=''>Filter By Continent</option>";

    $continents= getContinents(setConnectionInfo(DBCONNECTION,DBUSER,DBPASS));
    foreach($continents as $continent){
        echo "<option value='{$continent['ContinentCode']}'>{$continent['ContinentName']}</option>";
    }

    echo "</select>";
    $pdo=null;
}

function generateMap($city){
    $latitude = $city['Latitude'];
    $longitude = $city['Longitude'];

    $src = "https://maps.googleapis.com/maps/api/staticmap?center={$latitude},{$longitude}14&zoom=8&scale=1&size=390x310&maptype=roadmap&key=AIzaSyBAhEkdLdTVWcaBZVzD8LwGdtETG6HAFzI&format=jpg&visual_refresh=true";

    echo "<img class='maps' id='mapImage' src={$src}>";
}

function generateCityImages($pdo, $city){
    $citycode = $city['CityCode'];
    $sql = allImageSql() . ' WHERE imagedetails.CityCode =' . $citycode;
    $results = runQuery($pdo, $sql, $citycode);

    if($results != null){

        foreach($results as $photo){

            echo "<a href='single-photo.php?id={$photo['ImageID']}'>
                <picture>
                <source media='(max-width: 800px)' srcset='images/square75/" . strtolower( $photo['Path'] ) . "'>
                <img src='images/square150/" . strtolower( $photo['Path'] ) . "'>
                </picture>
                </a>";
        }
    }
    else{
        echo "<p>No images available for this city.</p>";
    }
    $pdo=null;
}

if(isset($_GET['citycode'])){
    $cityCode = $_GET['citycode'];
    $pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
    $results = getACity($pdo, $cityCode);


    foreach($results as $city){
    ?><!DOCTYPE html>

    <html>

    <head>
        <?php 
            $title = "City Page";
            include "includes/head.php";
        ?>
        <link rel="stylesheet" href="css/single-city.css">
    </head>

    <body>
        <form id="filtersCountryCityPage">
            <a href="javascript:void(0)" class="closebtn" id="close">&times;</a>
            <input id="searchCountriesCityPage" type="text" placeholder="Search For Country">
            <?php generateContinentsCityPage(); ?>                      
            <div>
                <input type="checkbox" id="imageCountryOnlyCityPage" name="imageCountry">Countries With Images Only
            </div>
            <button class="clearFilter" id="clearCountryCityPage">Clear All Country Filters</button>
        </form>
        <main class="container">
        <?php include "includes/navigation.php" ; ?>
        
            <div class="main" id="main-cityPage">
                <div id="filters">
                    <p id="clickMe">Filter Countries</p>
                </div>

                
                <div id="countryListCityPage">

                </div>

                <div id="mainContentCityPage">
                    <div class="details" id="cityDetails">
                        <?php generateCityDetails($city); ?>
                    </div>
                    <div id="cityMap">
                        <?php generateMap($city); ?>
                    </div>
                    <div id="cityPhotos">
                        <?php generateCityImages($pdo, $city); ?>
                    </div>
                </div>
            </div>

        </main>
    <?php
    } // end of for each
    $pdo=null;
}
else{
    header('Location:/error-page.php');
}


?>
</body>
    <script src="js/template.js"></script>
    <script src="js/single-city.js"></script>
    </html>
















