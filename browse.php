<?php
    require_once 'database/helper-functions.inc.php';
    
    $pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
    $countries = getCountriesWithImages($pdo);
    $cities = getCitiesWithImages($pdo);
    sort($cities);
    echo "<option value=''>Countries</option>";
    foreach ($cities as $c){
        echo $c['CityCode']. " ". $c['AsciiName'] . "<br> ";
    }
    
    function display(){
        if (isset($_POST['continents']) && $_POST['continents'] != ""){
            echo 'Continent selected is: ' . $_POST['continents'];
        
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
            
            <form method=post action=browse.php>
            
            <select name="countries" id="countryList">
                <option value="" >Countries</option>
                <?php
                    foreach($countries as $c){
                    echo '<option value="' .$c[ISO] . '">' . $c['CountryName'] . '</option>'; 
                    }
                ?>
            </select>

            <select name="cities" id="cityList">
                
                <option value="" >Cities</option>
                <?php
                    foreach($cities as $city){
                        echo 'option value="' .$c['CityCode']. '">'. $city['AsciiName'] . '</option>';
                    }
                ?>
            </select>


            


            <input type="checkbox" class="searchImage" name="countryImages" value="countryImgs">
            <input type="text" class="search" name="textSearch" placeholder="Search by image name">

            <input type='submit' value='post' />
            </form>
            </div>
            
            <div id="results">
            <h3>Browse/Search Results </h3>

                <?php display() ?>
            </div>
        </div>
    </main>

</html> 