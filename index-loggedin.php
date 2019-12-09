<?php 

session_start(); 

    require_once ('database/helper-functions.inc.php');
    require_once ('includes/imagesAlgorithm.php');

    if(isset($_SESSION['email'])){
        $userEmail = $_SESSION['email'];
        $pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
        $user = getUser($pdo, $userEmail);
        $pdo=null;
    }
    else{
        header('Location: login.php');
    }

    if(isset($_SESSION['favorite'])){
        $favArray = $_SESSION['favorite'];
    }
    else{
        $favArray = array();
    }
    


    function generateUserDetails($user){
        echo "<div id='name'><b>{$user['FirstName']} {$user['LastName']}</b></div>";
        echo "<div id='location'>{$user['City']}, {$user['Country']}</div>";
    }

    function displayFavorites($favArray){
        if($favArray != null || count($favArray) > 0){
            foreach($favArray as $pictureID){
                $pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
                $picture = getSingleImage($pdo, $pictureID);
    
                foreach($picture as $p){
                    echo "<div>";
                    // ----------- displays square images instead of small --------------- //
                    echo "<a href='single-photo.php?id={$p['ImageID']}'><img src='images/square150/{$p['Path']}'></a>";
                    echo "<p>{$p['Title']}</p>";
                    echo "<form id='fav' method='post'>";
                        echo "<input type='submit' class='remove' value='Remove from Favorites' name='remove'/>";
                        echo "<input type='hidden' name='removeID' value='" . $p['ImageID'] . "'><br><br>"; 
                    echo "</form>";
                    
                    echo "</div>";
                }
                $pdo=null;
            }
        }
        else{
            echo "<div id='error'>";
            echo "<p>You currently have no favorites ...</p>";
            echo "<p>Explore our gallery now!</p>";
            echo "<a href='browse.php'><img id='smartphone' src='images/smartphone.png'></a>";
            echo "</div>";
        }
    }

    if(isset($_POST["remove"])){
        unset($_POST["remove"]);
        if(isset($_SESSION['email'])){
    
            if(in_array($_POST['removeID'], $_SESSION['favorite'])){
                $key = array_search($_POST['removeID'],$_SESSION['favorite']);
                if($key!==false){
                    unset($_SESSION['favorite'][$key]);
                    $_SESSION['favorite'] = array_values($_SESSION['favorite']);
                    unset($_POST['removeID']);
                    $favArray = $_SESSION['favorite'];             
                }
            }
    
        }
    }

    function generateImagesAlgorithm($favArray){
        $sameCountry = findSameCountry($favArray);
        
        if(count($favArray) == 0){
            retrieveLastNumberResults($sameCountry, 12);
        }
        else{
            getImagesFromCountry($sameCountry);
        }
    }



?>
<!DOCTYPE html>
<html>
<head>
    <?php 
        $title = "Home - Logged in";
        include "includes/head.php";
    ?>
    <link rel="stylesheet" href="css/template.css">
    <link rel="stylesheet" href="css/index-loggedin.css">
</head>

<body>
    <main class="container">
    <?php include "includes/navigation.php" ; ?>
        <div class="main " id="main-loggedin">
            <div id="userInfo">
                <?=generateUserDetails($user)?>
            </div>
            <div id="favoritedImages">
                <h3>Your Favorites</h3>
                <?=displayFavorites($favArray);?>
            </div>
            
                <form id="textSearch" method='get' action='browse.php?textSearch='>
                    <input type="search" name="textSearch" placeholder="SEARCH FOR PHOTOS">
                </form>
            
            <div id="images">
                <h3>Images You May Like</h3>
                <?=generateImagesAlgorithm($favArray);?>
            </div>
        </div>
    </main>
</body>
<script src="js/template.js"></script>
</html>