<?php

require_once 'database/helper-functions.inc.php';

function generateCityDetails($city){
    echo "<h2>{$city['AsciiName']}</h2>";
    echo 
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
                <div id="cityFilters">City Filters</div>
                <div id="cityList">City List</div>
                <div id="mainContent">
                    <div class="details" id="cityDetails"><?php generateCityDetails($city); ?></div>
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
    <script src="js/single-country.js"></script>
    </html>
















