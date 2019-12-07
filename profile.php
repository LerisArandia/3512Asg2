<?php session_start(); ?>
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
                <img src="images/anon.png" id="profilePicture" alt="profile picture">
                <div id="userDescription">
                    <p><strong>John Doe</strong></p>
                    <p>Calgary, Canada </p>
                    <p>Bio: </p>
                    <p>Interests: </p>
                </div>
            </div>
            <div id="personalPhotos">
                Personal Photos (Photos they've uploaded)
            </div>
        </div>
    </main>
</body>


<script src="js/template.js"></script>
</html>