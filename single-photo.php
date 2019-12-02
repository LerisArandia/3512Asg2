<?php

require_once('config.inc.php');

if (isset($_GET["id"])){
    $id = $_GET["id"];
}else{
    $id = 0;
}

?>
<!DOCTYPE html>
<html>
<head>
    <?php 
        $title = "Single Photo View";
        include "includes/head.php";
    ?>
    <link rel="stylesheet" href="css/single-photo.css">
</head>

<body>
    <main class="container">
        <?php include "includes/navigation.php" ; ?>

        <div class="main" id=singlePhotoView>
            <!-- put image in here -->
            <div id=spvImg>image here</div>

            <!-- div for title, names, and location information -->
            <div id=spvNames>
                <h2 id="photoTitle">photo title</h2>
                <h3 id="photoUser">user name</h3>
                <h3 id="photoLocation">location</h3>

                <div class="spvButtons">
                    <button type="button" id="addFavorite">Add to favourites</button>
                </div>
            </div>


            <div id="infoBox">
                <!-- buttons for description, details and map -->
                <div class="spvButtons">
                    <!---Description Tab--->
                    <button type="button" id="spvDescTab"> Description</button>
                    <!---Details Tab--->
                    <button type="button" id="spvDetailsTab"> Details</button>
                    <!---Map Tab--->
                    <button type="button" id="spvMapTab"> Map</button>
                </div>
                <!-- divs for putting in the content for description, details, and map -->
                <!---Description Box--->
                <div id="spvDescBox"></div>
                <!---Details Box--->
                <div id="spvDetailsBox">
                    <div class='spvexif'></div>
                    <div class="spvcredit"></div>
                    <div class="spvcolors"></div>
                </div>
                <!---Map Box--->
                <div id="spvMapBox"></div>
            </div>
        </div>
    </main>
</body>
<script src="js/template.js"></script>
</html>