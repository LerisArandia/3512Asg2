<!DOCTYPE html>
<html>
<head>
    <?php 
        $title = "About";
        include "includes/head.php";
    ?>
    <link rel="stylesheet" href="css/about.css">
</head>

<body>
    <main class="container">
        <div id="header">
            <!-- insert logo here -->
            <!--For Media Query Nav-->
            <div id="hamburger-menu">&#9776;</div>
            <ul id="navigation">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="browse.php">Browse/Search</a></li>
                <li><a href="single-country.php">Countries</a></li>
                <li><a href="single-city.php">Cities</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="signUp.php">Sign Up</a></li>
            </ul>
        </div>
        <div class="main">
            <div id="aside">
                <div>Ralph Acusar: <a href="https://github.com/racus946">https://github.com/racus946</a></div>
                <div>Leris Arandia: <a href="https://github.com/LerisArandia">https://github.com/LerisArandia</a></div>
                <div>Jamie Wong: <a href="https://github.com/jaeemoo">https://github.com/jaeemoo</a></div>
                <div>Main Github Page: <a
                        href="https://github.com/racus946/3512Asg2">https://github.com/racus946/3512Asg2</a></div>
            </div>
            <div id="mainContent">
                <div id="details">Class Name, Uni, Prof, Name, Sem + Year, Tech Used</div>
                <div id="description">Description for Site</div>
            </div>
        </div>
    </main>
    <script src="js/template.js"></script>
</html>