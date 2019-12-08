<?php session_start(); 

//Checks if session variable favorite exists.
if(!isset($_SESSION['favorite'])){
    $_SESSION['favorite'] = array();
}

?>
<!DOCTYPE html>
<html>
<head>
    <?php 
        $title = "Favorites";
        include "includes/head.php";
    ?>
    <link rel="stylesheet" href="css/favorites.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">

</head>

<body>
    <main class="container">
    <?php include "includes/navigation.php" ; ?>
        <div class="main">
        <h2>Favorites</h2>

            <div id="favorites">
            <!-- 
                CAN YOU ADD A THING WHERE ITS LIKE OMG YOU DONT HAVE FAVORITES IF THERES NO FAVORITES
                ALSO THE VARIABLE WITH THE ARRAY IN IT IS CALLED
                FAVORITE
                WITH NO U
                YES
                OK
                HAVE FUN ILY <3
            -->
                <div>
                    <img src="images/aurora.jpg">
                </div>
                <div>2</div>
                <div>3</div>
                <div>4</div>
                <div>5</div>
                <div>6</div>
                <div>7</div>
                <div>8</div>
            </div>
            <!-- put images here -->
            
        </div>
    </main>
</body>
<script src="js/template.js"></script>
</html>