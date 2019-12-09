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
        $_SESSION['favorite'] = array();
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
                    echo "<a href='single-photo.php?id={$p['ImageID']}'><img src='images/square150/{$p['Path']}'></a>";
                    echo "<p>{$p['Title']}</p>";                    
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

    function generateUserPosts($user){
        $pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
        $postDetails = getUserPosts($pdo, $user['UserID']);
        foreach($postDetails as $details){
            echo "<div id='singlePost'>";
            echo "<a id='mainImage' href='single-photo.php?id={$details['MainPostImage']}'><img src='images/square150/{$details['Path']}'></a>";
            echo "<div>";
            echo "<h3 id='postTitle'>{$details['Title']}</h3>";
            echo "<p id='postMessage'>{$details['Message']}</p>";
            echo "<p id='postTime'><i>Posted on: {$details['PostTime']}</i></p>";
            echo "</div>";
            echo "</div>";
        }
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

            <div id="userPosts">    
                <?=generateUserPosts($user)?>
            </div>  
        </div>
    </main>
</body>


<script src="js/template.js"></script>
</html>