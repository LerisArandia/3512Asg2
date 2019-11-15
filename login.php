<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="css/template.css">
    <link rel="stylesheet" href="css/login.css">
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
                <li><a href="">Home</a></li>
                <li><a href="">About</a></li>
                <li><a href="">Browse/Search</a></li>
                <li><a href="">Countries</a></li>
                <li><a href="">Cities</a></li>
                <li><a href="">Login</a></li>
                <li><a href="">Sign Up</a></li>
            </ul>
        </div>
        <div class="main">
            <input type="text" id="email" placeholder="Enter Email" name="email" required>
            <input type="text" id="password" placeholder="Enter Password" name="password" required>
            <button type=button id="login">LOGIN</button>
            <button type=button id="signup">SIGN UP</button>
        </div>
    </main>
<script src="js/template.js"></script>
</html>