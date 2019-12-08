<?php session_start(); 

require_once('database/helper-functions.inc.php');

//Checks if session variable favorite exists.
if(!isset($_SESSION['favorite'])){
    $_SESSION['favorite'] = array();
}
else{
    $favArray = $_SESSION['favorite'];
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

if(isset($_POST["removeAll"])){
    unset($_POST["removeAll"]);
    if(isset($_SESSION['email'])){
        $_SESSION['favorite'] = [];
        $favArray = $_SESSION['favorite'];
    }
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
            <h2>Your Favorites</h2>

            <?php
                if(count($_SESSION['favorite']) > 0) : ?>
            <form id='removeAllForm' method='post'>
                <input type='submit' class='remove' value='Clear All Favorites' name='removeAll'/>
            </form>
                <?php endif;?>

            <div id="favorites">
                    <?=displayFavorites($favArray);?>
            </div>
            
        </div>
    </main>
</body>
<script src="js/template.js"></script>
</html>