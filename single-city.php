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
    <?php include "includes/navigation.php" ; ?>
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