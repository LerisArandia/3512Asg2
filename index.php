<?php 
session_start(); 

// if (isset($_SESSION['email'])) {
//     echo $_SESSION['email'];
//     header("Location: index-loggedin.php");
// }

// unset($_SESSION["email"]);
?>
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

            <form id="textSearch" method='get' action='browse.php?textSearch='>
            <input type="search" name="textSearch" placeholder="SEARCH FOR PHOTOS">
            </form>
        </div>
    </main>
</body>
<script src="js/template.js"></script>
<script src="js/logged-out.js"></script>
</html>