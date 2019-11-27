<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>

    <link rel="stylesheet" href="css/template.css">
    <link rel="stylesheet" href="css/upload.css">
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
        <div class="main">
            <h2>Upload Photo</h2>
            <div id="upload">
                <form id="uploadForm" action="lab12-test02.php" method="get">
                    <label for="title">Title:</label>
                    <br>
                    <input type="text" placeholder="Enter Title of Picture" name="title" required>
                    <br>
                    <label for="description">Description:</label>
                    <br>
                    <input type="textarea" rows="30" name="description" placeholder="Enter Photo's Description" />
                    <select name="country" id="country">
                        <option value="">Select Country</option>
                    </select>
                    <select name="city" id="city">
                        <option value="">Select City</option>
                    </select>
                    <br>
                    <input type="file" name="pic" accept="image/*">
                    <br>
                    <button id="submit" type="submit">Upload Your Photo!</button>
                </form>
            </div>
        </div>
    </main>
</body>


<script src="js/template.js"></script>
</html>