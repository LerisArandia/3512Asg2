<?php 
/** 
 * This page is the index for a LOGGED IN user.
 * This page includes:
 *      - User information & link to User profile
 *      - User favorites
 *      - Search bar for photos
 *      - Recommended photos for User 
 * 
*/
//Start Session
session_start(); 

//Helper function php
require_once ('database/helper-functions.inc.php');
//Image Algorithm php
require_once ('includes/imagesAlgorithm.php');

//Checks if session is set.
if(isset($_SESSION['email'])){
    $userEmail = $_SESSION['email'];
    $pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
    $user = getUser($pdo, $userEmail);
    $pdo=null;
}else{ //If there is no session, directs to login page. 
    header('Location: login.php');
}

//Checks for favorites session array
if(isset($_SESSION['favorite'])){
    $favArray = $_SESSION['favorite'];
}else{
    $favArray = array();
}
    

//Genereates user detail information
function generateUserDetails($user){
    //User Name
    echo "<div id='name'><b>{$user['FirstName']} {$user['LastName']}</b></div>";
    //User City and Country
    echo "<div id='location'>{$user['City']}, {$user['Country']}</div>";
}

//Displays user/session favorites 
function displayFavorites($favArray){
    //If favorites array does exists or is not empty
    if($favArray != null || count($favArray) > 0){
        foreach($favArray as $pictureID){
            $pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
            $picture = getSingleImage($pdo, $pictureID);
            //Displays each favorite photo and creates a remove favorite button.
            foreach($picture as $p){
                echo "<div>";
                /** Displays square images instead of small**/
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
    //If favorites does not exist or is not empty, displays that there are no favorites. 
    else{
        echo "<div id='error'>";
        echo "<p>You currently have no favorites ...</p>";
        echo "<p>Explore our gallery now!</p>";
        echo "<a href='browse.php'><img id='smartphone' src='images/smartphone.png'></a>";
        echo "</div>";
    }
}

//If remove photo form is clicked, remove photo from favorites
if(isset($_POST["remove"])){
    unset($_POST["remove"]);
    //Checks for session
    if(isset($_SESSION['email'])){
        //Finds photo in favorites and removes from favorites
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

//Prints photos from images algorithm
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
<!-- Start of HTML -->
<!DOCTYPE html>
<html>
<head>
    <?php 
        $title = "Home - Logged in";
        //Head Include
        include "includes/head.php";
    ?>
    <!-- CSS for index not logged in -->
    <link rel="stylesheet" href="css/index-loggedin.css">
</head>

<body>
    <main class="container">
    <!-- Navigation include -->
    <?php include "includes/navigation.php" ; ?>
        <div class="main " id="main-loggedin">
            <!-- User information -->
            <a id="userInfo" href='profile.php'>
                <div>
                    <?=generateUserDetails($user)?>
                </div>
            </a>
            <!-- User's Favorited Images -->
            <div id="favoritedImages">
                <h3>Your Favorites</h3>
                <?=displayFavorites($favArray);?>
            </div>
            <!-- Photo Search Bar -->
            <form id="textSearch" method='get' action='browse.php?textSearch='>
                <input type="search" name="textSearch" placeholder="SEARCH FOR PHOTOS">
            </form>
            <!-- Recommended Photos -->
            <div id="images">
                <h3>Images You May Like</h3>
                <?=generateImagesAlgorithm($favArray);?>
            </div>
        </div>
    </main>
</body>
<!---------- Scripts ---------->
<!-- Navigation/Base Javascript -->
<script src="js/template.js"></script>
</html>