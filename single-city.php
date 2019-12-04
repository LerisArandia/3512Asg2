<?php

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

    $continents= getContinents(setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS));
    foreach($continents as $continent){
        echo "<option value='{$continent['ContinentCode']}'>{$continent['ContinentName']}</option>";
    }

    echo "</select>";
}


if(isset($_GET['citycode'])){
    $cityCode = $_GET['citycode'];
    $pdo = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);
    $results = getACity($pdo, $cityCode);


    foreach($results as $city){
    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <?php 
            $title = "City Page";
            include "includes/head.php";
        ?>
        <link rel="stylesheet" href="css/single-city.css">
    </head>

    <body>
        <main class="container">
        <?php include "includes/navigation.php" ; ?>
            <div class="main" id="main-cityPage">
                <div id="filters">
                    <form id="filtersCountryCityPage">
                        <input id="searchCountriesCityPage" type="text" placeholder="Search For Country">
                        <?php generateContinentsCityPage(); ?>                      
                        <div><input type="checkbox" id="imageCountryOnlyCityPage" name="imageCountry">Countries With Images Only</div>
                        <button class="clearFilter" id="clearCountryCityPage">Clear All Country Filters</button>
                    </form>
                </div>

                <div id="cityList">

                </div>

                <div id="mainContentCityPage">
                    <div class="details" id="cityDetails">
                        <?php generateCityDetails($city); ?>
                    </div>
                    <div id="cityMap">City Map</div>
                    <div id="cityPhotos">City Photos</div>
                </div>
            </div>

        </main>
    <?php
    } // end of for each

    

    

}
else{
    echo "<h1>HEEEEYYYAAAAA</h1>";
}


?>
</body>
    <script src="js/template.js"></script>
    <script src="js/single-city.js"></script>
    </html>
















