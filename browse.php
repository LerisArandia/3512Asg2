<?php
require_once 'database/helper-functions.inc.php';

$pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
$allCountries = getCountriesWithImages($pdo);
$allCities = getCitiesWithImages($pdo);
$images = getAllImages($pdo);

// echo "<option value=''>Countries</option>";
// foreach ($cities as $city){
//     echo  $city['AsciiName'] . "<br> ";
// }

if (isset($_GET['cities']) && $_GET['cities'] != "") {
    echo 'City selected is: ' . $_GET['cities'];
    $cityID = $_GET['cities'];
    $cityImages = getCityImages($pdo, $cityID);
    $imagesArray = $cityImages;
} else if (isset($_GET['countries']) && $_GET['countries'] != "") {
    echo 'Country selected is: ' . $_GET['countries'];
    $countryID = $_GET['countries'];
    $countryImages = getCountryImages($pdo, $countryID);
    $imagesArray = $countryImages;
} else if (isset($_GET['textSearch']) && $_GET['textSearch'] != "") {
    // echo 'Text entered is ' . $_GET['textSearch'];
    $string = $_GET['textSearch'];
    $textSearchArray = [];


    // https://tecadmin.net/check-string-contains-substring-in-php/
    foreach ($images as $i) {
        // echo $string . " - " . $i['Title'] . "<br>";
        if (strpos(strtolower($i['Title']), strtolower($string)) !== false) {
            $textSearchArray[] = $i;
        }
    }
    $imagesArray = $textSearchArray;
} else {
    $imagesArray = $images;
}


function checkInput()
{ }
// foreach ($imagesArray as $i) {
//     echo "<br>" . $i['CountryCodeISO'] . "<br>";
// }

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

                <form method='get' name="filterForm" action='browse.php'>

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
                    <button type='submit' value='Submit' class='button'>Filter</button>

                </form>
            </div>

            <div id="results">
                <h3>Browse/Search Results </h3>

                <?php
                foreach ($imagesArray as $i) {
                    echo "<div>";
                    echo "<img src='images/medium640/" . $i['Path'] . "' width='150' height='150'>";
                    echo $i['Title'];
                    echo "<br>";
                    
                    echo "<a href='single-photo.php?id=" . $i['ImageID'] . "'>";
                    echo "<button> View </button>";
                    echo "</a>";

                    echo "</div>";
                }

                ?>


            </div>
        </div>
    </main>

</html>