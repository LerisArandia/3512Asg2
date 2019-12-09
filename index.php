<?php 
/**
 * The index/home page for NOT logged in user.
 * This page includes:
 *      - Button to login page
 *      - Button to register/join
 *      - A search bar to search photos
 * 
 */
//Starts Session
session_start(); 

//Checks if session is set.
if (isset($_SESSION['email'])) {
    //Changes to index-logged in php if there is a session
    header("Location: index-loggedin.php");
}
?>
<!-- Start of HTML -->
<!DOCTYPE html>
<html>
<head>
    <?php 
        $title = "Home - Logged out";
         //Head include
        include "includes/head.php";
    ?>
    <!-- CSS for index not logged in -->
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <main class="container">
    <!--Navigation bar include -->
    <?php include "includes/navigation.php" ; ?>
        <div class="main">
            <!-- Button that directs to Login page -->
            <button type=button id="login">LOGIN</button>
            <!-- Button that directs to registration/join page -->
            <button type=button id="join">JOIN</button>
            <!-- Form for search bar -->
            <form id="textSearch" method='get' action='browse.php?textSearch='>
            <input type="search" name="textSearch" placeholder="SEARCH FOR PHOTOS">
            </form>
        </div>
    </main>
</body>
<!---------- Scripts ---------->
<!-- Navigation/Base Javascript -->
<script src="js/template.js"></script>
<!-- Logged out Javascript-->
<script src="js/logged-out.js"></script>
</html>