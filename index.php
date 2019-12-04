<!DOCTYPE html>
<html>
<head>
    <?php 
        $title = "Home - Logged out";
        include "includes/head.php";
    ?>
    <link rel="stylesheet" href="css/index.css">
    
</head>

<body>
    <main class="container">
    <?php include "includes/navigation.php" ; ?>
        <div class="main">
            <!-- <div id="buttons"> -->
                <button type=button id="login">LOGIN</button>
                <button type=button id="join">JOIN</button>
            <!-- </div> -->
            <input type="search" name="searchPhotos" placeholder="SEARCH BOX FOR PHOTOS">
        </div>
    </main>
</body>
<script src="js/template.js"></script>
<script src="js/index-loggedOut.js"></script>
</html>