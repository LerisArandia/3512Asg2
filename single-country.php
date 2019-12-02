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
    <?php include "includes/navigation.php" ; ?>
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