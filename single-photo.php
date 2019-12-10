<?php
/**
 * The Single Photo View PHP. 
 * Presents photo, photo information and a button to add to favorites for a specific photo.
 * Single Photo takes an ID parameter (ID for the photo that is being viewed)
 * 
 */
//Start session 
session_start();

//Helper function php
require_once 'database/helper-functions.inc.php';

//Checks if session variable favorite exists.
if(!isset($_SESSION['favorite'])){
    $_SESSION['favorite'] = array();
}

//If page is given a URL parameter
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    //If id is not 0 
    if($id != 0){
        //Grabs image information
        $pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
        $image = getSingleImage($pdo, $id);
        foreach($image as $i){
            //Decodes JSON for Exif information
            $exifArray = json_decode($i['Exif'], true);
            //Decodes JSON for colors information
            $colorArray = json_decode($i['Colors'], true);
            //The function generates details information
            function generateDetails($i, $exif, $colors){
                //Exif and credit information
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
                //Color information 
                echo "  </div>
                        <div class=\"spvcolors\">";
                            foreach($colors as $c){
                                echo "<span style=\"background-color: " . $c . "\">" . $c . "</span>";
                            }
                echo "  </div>";
            }                  
?>
<!-- Start of HTML -->
<!DOCTYPE html>
    <html>
    <head>
        <?php
            $title = "Single Photo View";
            //Head include
            include "includes/head.php";
        ?>
        <!-- CSS for single photo -->
        <link rel="stylesheet" href="css/single-photo.css">
    </head>

    <body>
        <main class="container">
            <!--Navigation bar include -->
            <?php include "includes/navigation.php"; ?>
            <div class="main" id="singlePhotoView">
            <!--Displays when favorites is added/deleted-->
            <div id="changeFav"></div>
                <!-- The Image -->
                <div id="spvImg">
                    <picture>
                        <!-- When window size is 1250px or smaller -->
                        <source media="(max-width:1250px)" srcset="images/medium640/<?php echo strtolower($i['Path']); ?>">
                        <!-- Whne window size if 1250px or greater -->
                        <img src="images/medium800/<?php echo strtolower($i['Path']);?>" alt="<?php echo $id;?>" id="singleImage">
                    </picture>
                </div>
                <!-- Hover box on Image  -->
                <div id="hoverBox"><?php generateDetails($i, $exifArray, $colorArray); ?></div>
                <!-- div for title, creator names, and location information -->
                <div id="spvNames">
                    <!-- div for Title -->
                    <h2 id="photoTitle"><?php echo $i['Title']; ?></h2>
                    <!-- div for Creator name -->
                    <h3 id="photoUser"><?php echo $i['ActualCreator']; ?></h3>
                    <!-- div for Location (City and Country) -->
                    <h3 id="photoLocation"><?php echo "<a href='single-city.php?citycode={$i['CityCode']}'>{$i['AsciiName']}</a>, <a href='single-country.php?countryiso={$i['CountryCodeISO']}'>{$i['CountryName']}</a>" ?></h3>
                    
                    <?php
                        if(isset($_SESSION['email'])){
                            //Favorites Form/Button
                            echo '<form class="spvButtons" method="post" id="fav">';
                                //If image is in session favorites array, show remove favorites button
                                if(in_array($i['ImageID'], $_SESSION['favorite'])){
                                    //Remove from Favorites button
                                    echo '<input type="submit" id="remove" class="favorite" value="Remove from Favorites" name="remove"/>';
                                    //Post information for type of button
                                    echo "<input type='hidden' id='btn' name='btn' value='remove'/>";
                                }else{ //Else if image is NOT in session favorites array, show add to favorites button
                                    //Add to Favorites button
                                    echo '<input type="submit" id="addFavorite" class="favorite" value="Add to Favorites" name="favorite"/>';
                                    //Post information for type of button
                                    echo "<input type='hidden' id='btn' name='btn' value='favorite'/>";
                                }
                                //Post information for photo id. 
                                echo "<input type='hidden' id='photoID' name='id' value='" . $i['ImageID'] . "'>";
                            echo '</form>';
                        }

                    ?>
                </div>

                <!--Information box for photo description, details and map-->
                <div id="infoBox">
                    <!-- Buttons for description, details and map -->
                    <div class="spvButtons">
                        <!---Description Tab--->
                        <button type="button" id="spvDescTab">Description</button>
                        <!---Details Tab--->
                        <button type="button" id="spvDetailsTab">Details</button>
                        <!---Map Tab--->
                        <button type="button" id="spvMapTab">Map</button>
                    </div>
                    <!-- Divs for description, details, and map content-->
                    <!---Description Box--->
                    <div id="spvDescBox"><?php echo $i['Description']; ?></div>
                    <!---Details Box--->
                    <div id="spvDetailsBox"><?php generateDetails($i, $exifArray, $colorArray); ?></div>
                    <!---Map Box--->
                    <div id="spvMapBox"></div>
                </div>
            </div>
        </main>
    <?php
        }
    }else{ //Sends to error page if photo id does not exist
        header('Location:/error-page.php');
    }
    $pdo=null;
} else { //Sends to error page if no parameter is given
    header('Location:/error-page.php');
}
?>

    </body>
<!----------Scripts---------->
<!--Navigation/Base Javascript-->
<script src="js/template.js"></script>
<!--Single Photo Javascript-->
<script src="js/single-photo.js"></script>
<!--Favorites Button Javascript-->
<script src="js/favorites.js"></script>
<!---Interactive Map--->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvRG7tyWWBJc3cGLMMfjYsAHFHM-dB7QA&callback=initMap"></script>
</html>