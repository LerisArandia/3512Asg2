<?php
    require_once 'database/helper-functions.inc.php';
    
    $pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
    $countries = getCountriesWithImages($pdo);
    $cities = getCitiesWithImages($pdo);
    
    // echo "<option value=''>Countries</option>";
    // foreach ($cities as $city){
    //     echo  $city['AsciiName'] . "<br> ";
    // }
    
    function display(){
        if (isset($_GET['cities']) && $_GET['cities'] != ""){
            echo 'City selected is: ' . $_GET['cities'];
        
        } 
        if (isset($_POST['countries']) && $_POST['countries'] != ""){
            echo 'Continent selected is: ' . $_POST['countries'];
            
        } 

        if (isset($_POST['textSearch']) && $_POST['textSearch'] != ""){
            echo 'Text entered is ' . $_POST['textSearch'];
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
    include "includes/navigation.php" ; 
    ?>
        <div class="main">
            <div id="photoFilter">
            
            <h3>Photo Filter</h3>
            
            <form method=get action=browse.php>
            
            <select name="cities" id="cityList">
                <option value="" >Cities</option>
                <?php
                    foreach ($cities as $city)
                    {
                        echo '<option value="' . $city['CityCode'] . '">' . $city['AsciiName'] . '</option>';
                    }
                ?>
            </select>


            <select name="countries" id="countryList">
                <option value="" >Countries</option>
                <?php
                    foreach($countries as $c){
                    echo '<option value="' .$c['ISO'] . '">' . $c['CountryName'] . '</option>'; 
                    }
                ?>
            </select>


            <input type="checkbox" class="searchImage" name="countryImages" value="countryImgs">
            <input type="text" class="search" name="textSearch" placeholder="Search by image name">

            <input type='submit' value='Submit' />
            </form>
            </div>
            
            <div id="results">
            <h3>Browse/Search Results </h3>

                <?php display() ?>
            </div>
        </div>
    </main>

</html> 