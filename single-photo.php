<?php

require_once 'database/helper-functions.inc.php';



if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $pdo = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);
    $sql = getImageSql() . " WHERE ImageID='" . $id . "'";
    $result = $pdo->query($sql);
    $image = $result->fetch();
    extract($image);

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
                <div id="spvImg"><?php echo $Path; ?></div>
                <div id="hoverBox">
                    <div class='spvexif'></div>
                    <div class="spvcredit"></div>
                    <div class="spvcolors"></div>
                </div>
                <!-- div for title, names, and location information -->
                <div id="spvNames">
                    <h2 id="photoTitle"><?php echo $Title; ?></h2>
                    <h3 id="photoUser"><?php echo $ActualCreator; ?></h3>
                    <h3 id="photoLocation"><?php echo $AsciiName . ', ' . $CountryName; ?></h3>

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
                    <div id="spvDescBox"><?php echo $Description; ?></div>
                    <!---Details Box--->
                    <div id="spvDetailsBox">
                        <div class='spvexif'>
                            <h3>Exif Information:</h3>
                            <?php 
                                if($Exif == ""){
                                    echo "NONE";
                                }else {
                                    
                                    echo "<b>Make:</b> $exif"; 
                                }
                            ?>
                        </div>
                        <div class="spvcredit">
                            <h3>Credit:</h3>
                            <?php
                                if($SourceURL == ""){
                                    $SourceURL = "NONE";
                                }
                                echo "<b>Actual Creator:</b> $ActualCreator <br>";
                                echo "<b>Creator:</b> $CreatorURL <br>";
                                echo "<b>Source:</b> $SourceURL <br>"
                            ?>
                        </div>
                        <div class="spvcolors">
                            <?php
                            echo $Colors;
                            ?>
                        </div>
                    </div>
                    <!---Map Box--->
                    <div id="spvMapBox"></div>
                </div>
            </div>
        </main>

<?php

} else {
    echo "<h1>ERROR: PAGE DOES NOT EXIST.</h1>";
}
?>

    </body>
    <script src="js/template.js"></script>
    <script src="js/single-photo.js"></script>
</html>