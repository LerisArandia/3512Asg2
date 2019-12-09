<?php
if(isset($_SESSION['email'])){
    session_start();
}

require_once 'database/helper-functions.inc.php';
include 'includes/addFavorite.php';
include 'includes/removeFavorite.php';

//Checks if session variable favorite exists.
if(!isset($_SESSION['favorite'])){
    $_SESSION['favorite'] = array();
}

/**********Adding to Favorites**********/
if(isset($_POST["fav"])){
    unset($_POST['fav']);
    if(isset($_SESSION['email'])){
        if(!in_array($_POST['saveID'], $_SESSION['favorite'])){
            $_SESSION['favorite'][] = $_POST['saveID'];
            unset($_POST['saveID']);
            //var_dump($_SESSION);
        }
    }else{
        unset($_POST['fav']);
        header("Location: login.php");  
    }
}
if(isset($_POST["remove"])){
    unset($_POST['remove']);
    if(isset($_SESSION['email'])){
        if(in_array($_POST['removeID'], $_SESSION['favorite'])){
            $key = array_search($_POST['removeID'],$_SESSION['favorite']);
            if($key!==false){
                unset($_SESSION['favorite'][$key]);
                $_SESSION['favorite'] = array_values($_SESSION['favorite']);
                unset($_POST['removeID']);
                //var_dump($_SESSION);
                
            }
        }
    }
}

$pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
$allCountries = getCountriesWithImages($pdo);
$allCities = getCitiesWithImages($pdo);
$images = getAllImages($pdo);
$imagesArray = array();
// echo "<option value=''>Countries</option>";
// foreach ($cities as $city){
//     echo  $city['AsciiName'] . "<br> ";
// }

if (isset($_GET['cities']) && $_GET['cities'] != "") {
    // echo 'City selected is: ' . $_GET['cities'];
    $cityID = $_GET['cities'];
    $cityImages = getCityImages($pdo, $cityID);
    $imagesArray = $cityImages;
    
} else if (isset($_GET['countries']) && $_GET['countries'] != "") {
    // echo 'Country selected is: ' . $_GET['countries'];
    $countryID = $_GET['countries'];
    $countryImages = getCountryImages($pdo, $countryID);
    $imagesArray = $countryImages;
    

} else if (isset($_GET['textSearch']) && $_GET['textSearch'] != "") {
    // echo 'Text entered is ' . $_GET['textSearch'];
    $string = $_GET['textSearch'];
    $textSearchArray = [];


    // https://tecadmin.net/check-string-contains-substring-in-php/
    // finds matching input in any of the image titles
    foreach ($images as $i) {
        // echo $string . " - " . $i['Title'] . "<br>";
        if (strpos(strtolower($i['Title']), strtolower($string)) !== false) {
            $textSearchArray[] = $i;
        } 
    }
    $imagesArray = $textSearchArray;
    $pdo=null;
   
} else {
    $imagesArray = $images;
}

function removeFilter(){
    if ((isset($_GET['cities']) && $_GET['cities'] != "") || 
    (isset($_GET['countries']) && $_GET['countries'] != "") ||
    (isset($_GET['textSearch']) && $_GET['textSearch'] != "")) {
        echo "<button id='removeFilter' type='submit' value='Submit' class='button'>Remove Filter</button>";
    }
}

function errorMessage($imagesArray){
    if (count($imagesArray) == 0){
        echo "Input does not match any title name. Please re-enter";
    }
}

?>

<html>
<head>
    <?php
    $title = "Search & Browse";
    include "includes/head.php";
    ?>
    <link rel="stylesheet" href="css/browse.css">
</head>

<body>
    <main class="container">
        <?php
        include "includes/navigation.php";
        ?>
        <div class="main">
            <div id="photoFilter">

                <h3>Photo Filter</h3>

                <form id="filters" method='get' name="filterForm" action='browse.php'>

                    <select name="cities" id="cityList">
                        <option value="">Cities</option>
                        <?php
                        foreach ($allCities as $city) {
                            echo '<option value="' . $city['CityCode'] . '">' . $city['AsciiName'] . '</option>';
                        }
                        ?>
                    </select>


                    <select name="countries" id="countryList">
                        <option value="">Countries</option>
                        <?php
                        foreach ($allCountries as $country) {
                            echo '<option value="' . $country['ISO'] . '">' . $country['CountryName'] . '</option>';
                        }
                        ?>
                    </select>


                    <!-- <input type="checkbox" class="searchImage" name="countryImages" value="countryImgs"> -->
                    <input type="text" class="search" name="textSearch" placeholder="Search by image name">

                    <!-- Submit button -->
                    <button id="submitFilter" type='submit' value='Submit' class='button'>Filter</button>

                    <?php removeFilter(); ?>
                </form>
            </div>

            <div id="allResults">
                <h3>Browse/Search Results </h3>

                <?php
                errorMessage($imagesArray);
                foreach ($imagesArray as $i) {
                    echo "<div id='singleResult'>";
                    echo "<img id='image' src='images/medium640/" . $i['Path'] . "' width='150' height='150'>";
                    echo "<div id='imageTitle'>{$i['Title']}</div>";
                    echo "<br>";

                    echo "<a id='view' href='single-photo.php?id=" . $i['ImageID'] . "'>";
                    echo "<button> View </button>";
                    echo "</a>";

                    echo "<form id='fav' method='post'>";
                    
                    $key = array_search($i['ImageID'],$_SESSION['favorite']);
                    if(in_array($i['ImageID'], $_SESSION['favorite']) && $key!==false){
                        echo "<input type='submit' id='remove' value='Remove from Favorites' name='remove'/>";
                    }else{
                        echo "<input type='submit' id='addFavorite' value='Add to Favorites' name='favorite'/>";
                    }
                    echo "<input type='hidden' name='id' value='" . $i['ImageID'] . "'>";
                    echo "</form>";

                    echo "</div>";
                }

                ?>


            </div>
        </div>
    </main>
    <script src="js/template.js"></script>
</html>