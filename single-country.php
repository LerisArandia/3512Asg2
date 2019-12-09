
<?php
session_start();
require_once 'database/helper-functions.inc.php';

function generateCountryDetails(){
    if(isset($_GET['countryiso'])){
        $pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
        $countries = getACountry($pdo, $_GET['countryiso']);
        
        foreach($countries as $country){
            echo "<h3>{$country['CountryName']}</h3>";
            echo "<div id='capital'>Capital: {$country['Capital']}</div>";
            echo "<div id='area'>Area: ".number_format($country['Area'])."</div>";
            echo "<div id='domain'>Domain: {$country['TopLevelDomain']} </div>";
            echo "<div id='currency'>Currency: {$country['CurrencyName']}</div>";
            echo "<div id='Population'>Population: ".number_format($country['Population'])." residents</div>";
            echo "<div id='description'>{$country['CountryDescription']}</div>";
            echo "<div id='neighbours'>Neighbours: ".findNeighboringCountries($pdo, $country['Neighbours'])."</div>";
            echo "<div id='languages'>Languages: ".findLanguages($pdo, $country['Languages'])."</div>";
        }
        
        $pdo=null;
    }
    else{
        echo '<h3>Country Details</h3>';
        echo '<p>Choose a country through our filters to find out more information!</p>';
    }
    
} 

function generateCities(){
    if(isset($_GET['countryiso'])){
        $pdo = setConnectionInfo(DBCONNECTION,DBUSER,DBPASS);
        $city = getAllCitiesInCountry($pdo, $_GET['countryiso']);
        echo "<h3>Cities</h3>";
        if($city != null){
            foreach($city as $c){
                echo "<a href='single-city.php?citycode={$c['CityCode']}'>{$c['AsciiName']}</a>";
                echo "<br>";
            }
        }
        else{
            echo 'No cities are available to show for this country.';
        }
        
        $pdo=null;
    }
    else{
        echo '<h3>Cities</h3>';
    }
}

function generateContinents(){
    echo "<select name='continent' id='continent' placeholder='Search By Continent'>";
    echo "<option value=''>Filter By Continent</option>";
    
    $continents= getContinents(setConnectionInfo(DBCONNECTION,DBUSER,DBPASS));
    foreach($continents as $continent){
        echo "<option value='{$continent['ContinentCode']}'>{$continent['ContinentName']}</option>";
    }
    echo "</select>";
    $pdo=null;
}

function generateCountryImages(){
    if(isset($_GET['countryiso'])){
        $countrycode = $_GET['countryiso'];
        $pdo = setConnectionInfo(DBCONNECTION,DBUSER,DBPASS);
        $sql = allImageSql() . " WHERE imagedetails.CountryCodeISO ='". $countrycode."'";
        $results = runQuery($pdo, $sql, $countrycode);
        
        if ($results != null){
            foreach($results as $photo){
                echo "<a href='single-photo.php?id={$photo['ImageID']}'>
                <picture>
                <source media='(max-width: 800px)' srcset='images/square75/" . strtolower($photo['Path']) . "'>
                <img src='images/square150/" . strtolower( $photo['Path']) . "'>
                </picture>
                </a>";
            }    
        }
        else{
            echo "<p>No images available for this country.</p>";
        }
        
        $pdo=null;
    }
    else{
        echo '<h3>Country Images</h3>';
    }
}

?><!DOCTYPE html>
<html>
    
    <head>
        <?php 
        $title = "Country Page";
        include "includes/head.php";
        ?>
    <link rel="stylesheet" href="css/single-country.css">
    
</head>

<body>
    <form id="filters">
        <!-- 
         https://www.w3schools.com/howto/howto_js_sidenav.asp
        hiding sidenav
         -->
        <div>
            <a href="javascript:void(0)" class="closebtn" id="close">&times;</a>
                <input id="searchCountries" type="text" placeholder="Search For Country">
                <?php generateContinents(); ?>
                <div>
                    <input type="checkbox" id="imageCountryOnly" name="imageCountry">Countries With Images Only
                </div>
                <button class="clearFilter" id="clearCountry">Clear All Country Filters</button>
            </div>
        </form>        
        <main class="container">
            <?php include "includes/navigation.php" ; ?>
            <div class="main" id="main-countryPage">
                <div id="countryFilters">
                    <p id="clickMe">Filter Countries</p>
                </div>
                
                <div id="countryList"></div>
                
                <div id="mainContent">
                    <div class="details" id="countryDetails"><?php  generateCountryDetails(); ?>
                </div>
                <div id="cityList">
                    <?php generateCities(); ?>
                </div>
                <div id="countryPhotos"><?php generateCountryImages(); ?></div>
            </div>
        </div>
    </main>
    
<script src="js/template.js"></script>
<script src="js/single-country.js"></script>
</body>


</html>