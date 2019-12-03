<?php
    require_once 'helper-functions.inc.php';

    $pdo = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);

    function display(){
        if (isset($_POST['continents']) && $_POST['continents'] != ""){
            echo 'Continent selected is: ' . $_POST['continents'];
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
        // include "includes/head.php";
    ?>
    <link rel="stylesheet" href="css/browse.css">
</head>

<body>
    <main class="container">
    <?php 
    // include "includes/navigation.php" ; 
    ?>
        <div class="main">
            <div id="photoFilter">
            
            <h3>Photo Filter</h3>
            
            <form method=post action=browse.php>
            
            <select name="continents" id="continentList">
                <option value="" >Cities</option>
                <option value="AF">Africa</option>
                <option value="AN">Antarctica</option>
                <option value="AS">Asia</option>
                <option value="EU">Europe</option>
                <option value="NA">North America</option>
                <option value="OC">Oceania</option>
                <option value="SA">South America</option>
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