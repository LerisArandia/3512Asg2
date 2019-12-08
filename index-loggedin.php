<?php 
    session_start(); 

    require_once ('database/helper-functions.inc.php');
    if(isset($_SESSION['email'])){
        $userEmail = $_SESSION['email'];
        $pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
        $user = getUser($pdo, $userEmail);
        $pdo=null;
    }
    else{
        header('Location: login.php');
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
                <p>Your Favorites</p>
            </div>
            
                <form id="textSearch" method='get' action='browse.php?textSearch='>
                    <input type="search" name="textSearch" placeholder="SEARCH FOR PHOTOS">
                </form>
            
            <div id="images">images
                
            </div>
        </div>
    </main>
</body>
<script src="js/template.js"></script>
</html>