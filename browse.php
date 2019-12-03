<?php



    function display(){
        if (isset($_POST['continents']) && $_POST['continents']!=""){
            echo 'Continent selected is: ' . $_POST['continents'];
        } 
    }
    
    $citiesArray = 
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search/Browse</title>

    <link rel="stylesheet" href="css/template.css">
    <link rel="stylesheet" href="css/browse.css">
</head>

<body>
    <main class="container">
        <div id="header">
            <!-- insert logo here -->
            <!--For Media Query Nav-->
            <div id="hamburger-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul id="navigation">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="browse.php">Browse/Search</a></li>
                <li><a href="single-country.php">Countries</a></li>
                <li><a href="single-city.php">Cities</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="signUp.php">Sign Up</a></li>
            </ul>
        </div>
        <div class="main">
            <div id="photoFilter">
            
            <h3>Photo Filter</h3>
            
            <form method=post action=browse.php>
            
            <select name="continents" id="continentList">
                <option value="" >Continents</option>
                <option value="AF">Africa</option>
                <option value="AN">Antarctica</option>
                <option value="AS">Asia</option>
                <option value="EU">Europe</option>
                <option value="NA">North America</option>
                <option value="OC">Oceania</option>
                <option value="SA">South America</option>
            </select>
            <input type="checkbox" class="searchImage" name="countryImages" value="countryImgs">
            <input type="text" class="search" placeholder="Search by image name">

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