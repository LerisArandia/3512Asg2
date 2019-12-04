<?php

require_once 'database/helper-functions.inc.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    if($id != 0){
        $pdo = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);
        $image = getSingleImage($pdo, $id);
        foreach($image as $i){
            $exifArray = json_decode($i['Exif'], true);
            $colorArray = json_decode($i['Colors'], true);
            
            function generateDetails($i, $exif, $colors){
                echo "  <div class='spvexif'>
                            <h3>Exif Information:</h3>
                            <b>Make: </b>" . $exif['make'] ."<br>
                            <b>Model: </b>" . $exif['model'] ."<br>
                            <b>Exposure Time: </b>" . $exif['exposure_time'] ."<br>
                            <b>Aperture: </b>" . $exif['aperture'] ."<br>
                            <b>Focal Length: </b>" . $exif['focal_length'] ."<br>
                            <b>ISO: </b>" . $exif['iso'] ."<br>
                        </div>
                        <div class=\"spvcredit\">
                            <h3>Credit:</h3>";
                                if($i['SourceURL'] == ""){
                                    $i['SourceURL'] = "NONE";
                                }
                                echo "<b>Actual Creator:</b>" . $i['ActualCreator'] . "<br>";
                                echo "<b>Creator:</b> " . $i['CreatorURL'] . " <br>";
                                echo "<b>Source:</b> " . $i['SourceURL'] . " <br>";
                echo "  </div>
                        <div class=\"spvcolors\">";
                            foreach($colors as $c){
                                echo "<span style=\"background-color: " . $c . "\">" . $c . "</span>";
                            }
                echo "  </div>";
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
            <?php include "includes/navigation.php"; ?>

            <div class="main" id="singlePhotoView">
                <!-- put image in here -->
                <div id="spvImg">
                    <picture>
                        <source media="(max-width: 1250px)" srcset="images/medium640/<?php echo $i['Path']; ?>">
                        <img src="images/medium800/<?php echo $i['Path'];?>" alt="<?php echo $id;?>" id = "singleImage">
                    </picture>
                </div>
                <div id="hoverBox">
                    <?php
                        generateDetails($i, $exifArray, $colorArray);
                    ?>
                </div>
                <!-- div for title, names, and location information -->
                <div id="spvNames">
                    <h2 id="photoTitle"><?php echo $i['Title']; ?></h2>
                    <h3 id="photoUser"><?php echo $i['ActualCreator']; ?></h3>
                    <h3 id="photoLocation"><?php echo $i['AsciiName'] . ', ' . $i['CountryName']; ?></h3>

                    <div class="spvButtons">
                        <button type="button" id="addFavorite">Add to favourites</button>
                    </div>
                </div>


                <div id="infoBox">
                    <!-- buttons for description, details and map -->
                    <div class="spvButtons">
                        <!---Description Tab--->
                        <button type="button" id="spvDescTab">Description</button>
                        <!---Details Tab--->
                        <button type="button" id="spvDetailsTab">Details</button>
                        <!---Map Tab--->
                        <button type="button" id="spvMapTab">Map</button>
                    </div>
                    <!-- divs for putting in the content for description, details, and map -->
                    <!---Description Box--->
                    <div id="spvDescBox"><?php echo $i['Description']; ?></div>
                    <!---Details Box--->
                    <div id="spvDetailsBox">
                        <?php
                            generateDetails($i, $exifArray, $colorArray);
                        ?>
                    </div>
                    <!---Map Box--->
                    <div id="spvMapBox"></div>
                </div>
            </div>
        </main>
    <?php
        }
    }else{
        echo "<h1>ERROR: IMAGE DOES NOT EXIST.</h1>";
    }
} else {
    echo "<h1>ERROR: PAGE DOES NOT EXIST.</h1>";
}
?>

    </body>
    <script src="js/template.js"></script>
    <script src="js/single-photo.js"></script>
    <!---Interactive Map--->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKSRi8PKjVcfWXCkYF7xFy_uT-P6pmUvg&callback=initMap"></script>
</html>