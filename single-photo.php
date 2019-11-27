<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Photo View</title>

    <link rel="stylesheet" href="css/template.css">
    <link rel="stylesheet" href="css/single-photo.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
</head>

<body>
    <main class="container">
        <div id="header">
            <!-- insert logo here -->
            <!--For Media Query Nav-->
            <div id="hamburger-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
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

        <div class="main" id=singlePhotoView>
            <!-- put image in here -->
            <div id=spvImg>image here</div>

            <!-- div for title, names, and location information -->
            <div id=spvNames>
                <h2 id="photoTitle">photo title</h2>
                <h3 id="photoUser">user name</h3>
                <h3 id="photoLocation">location</h3>

                <div class="spvButtons">
                    <button type="button" id="addFavorite">Add to favourites</button>
                </div>
            </div>


            <div id="infoBox">
                <!-- buttons for description, details and map -->
                <div class="spvButtons">
                    <button type="button" id="spvDesc"> Description</button>
                    <button type="button" id="spvDetails"> Details</button>
                    <button type="button" id="spvMap"> Map</button>
                </div>
                <!-- div for putting in the content for description, details, and map -->
                <div id="spvInfo"></div>
            </div>
        </div>
    </main>
</body>
<script src="js/template.js"></script>
</html>