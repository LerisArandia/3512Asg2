<?php
session_start();
require_once 'database/helper-functions.inc.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    if($id != 0){
        $pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
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
                                echo "<b>Actual Creator: </b>" . $i['ActualCreator'] . "<br>";
                                echo "<b>Creator: </b> " . $i['CreatorURL'] . " <br>";
                                echo "<b>Source:</b> " . $i['SourceURL'] . " <br>";
                echo "  </div>
                        <div class=\"spvcolors\">";
                            foreach($colors as $c){
                                echo "<span style=\"background-color: " . $c . "\">" . $c . "</span>";
                            }
                echo "  </div>";
            }                  
?><!DOCTYPE html>
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
                        <source media="(max-width:1250px)" srcset="images/medium640/<?php echo strtolower($i['Path']); ?>">
                        <img src="images/medium800/<?php echo strtolower($i['Path']);?>" alt="<?php echo $id;?>" id="singleImage">
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
                    <h3 id="photoLocation"><?php echo "<a href='single-city.php?citycode={$i['CityCode']}'>{$i['AsciiName']}</a>, <a href='single-country.php?countryiso={$i['CountryCodeISO']}'>{$i['CountryName']}</a>" ?></h3>

                    <?php
                        if(isset($_POST["favorite"])){
                            if(isset($_SESSION['email'])){

                            }else{
                                header("Location: login.php");
                            }
                        }
                    ?>

                    <form class="spvButtons" method="post">
                        <input type="submit" id="addFavorite" value="Add to Favourites" name="favorite"/>
                    </form>
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
    $pdo=null;
} else {
    header('Location:/error-page.php');
}
?>

    </body>
    <script src="js/template.js"></script>
    <script src="js/single-photo.js"></script>
    <!---Interactive Map--->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvRG7tyWWBJc3cGLMMfjYsAHFHM-dB7QA&callback=initMap"></script>
</html>