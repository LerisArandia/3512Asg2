<?php 
    require_once ('database/helper-functions.inc.php');
    session_start(); 
    if(isset($_SESSION['email'])){
        $userEmail = $_SESSION['email'];
        $pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
        $user = getUser($pdo, $userEmail);
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
            <div id="favPhotos">
                <h3>Favorited Photos</h3>
            </div>
        </div>
    </main>
</body>


<script src="js/template.js"></script>
</html>