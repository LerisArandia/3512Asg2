<?php 
    require_once ('database/helper-functions.inc.php');
    session_start(); 
    if(isset($_SESSION['email'])){
        $userEmail = $_SESSION['email'];
        $pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
        $user = getUser($pdo, $userEmail);
        $pdo=null;
    }
    else{
        header('Location: login.php');
    }

    if(!isset($_SESSION['favorite'])){
        $favArray = array();
    }
    else{
        $favArray = $_SESSION['favorite'];
    }

    function displayFavorites($favArray){
        if($favArray != null || count($favArray) > 0){
            foreach($favArray as $pictureID){
                $pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
                $picture = getSingleImage($pdo, $pictureID);
    
                foreach($picture as $p){
                    echo "<div>";
                    echo "<a href='single-photo.php?id={$p['ImageID']}'><img src='images/small320/{$p['Path']}'></a>";
                    echo "<p>{$p['Title']}</p>";
                    // echo "<form id='fav' method='post'>";
                    //     echo "<input type='submit' class='remove' value='Remove from Favorites' name='remove'/>";
                    //     echo "<input type='hidden' name='removeID' value='" . $p['ImageID'] . "'><br><br>"; 
                    // echo "</form>";
                    
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

    function generateUserDetails($user){
        echo "<div id='name'><b>{$user['FirstName']} {$user['LastName']}</b></div>";
        echo "<div id='location'>{$user['City']}, {$user['Country']}</div>";
    }


?>
<!DOCTYPE html>
<html>
<head>
    <?php 
        $title = "Profile";
        include "includes/head.php";
    ?>
    <link rel="stylesheet" href="css/profile.css">
</head>

<body>
    <main class="container">
    <?php include "includes/navigation.php" ; ?>
        <div class="main">
            <div id="userInfo">
                <div id="userDescription">
                    <?=generateUserDetails($user)?>
                </div>
            </div>
            <div id="favorites">
                <h3>Favorited Photos</h3>
                <div id="favPhotos">
                    <?=displayFavorites($favArray)?>
                </div>
            </div>
        </div>
    </main>
</body>


<script src="js/template.js"></script>
</html>