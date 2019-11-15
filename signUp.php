<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration</title>
    
        <link rel="stylesheet" href="css/template.css">
        <link rel="stylesheet" href="css/signUp.css">
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
            <h2>Create an Account</h2>
            <div id="register">
                <form id="registerForm" action="php" method="post"> 
                    <input type="text" placeholder="First Name" name="fName">
                    <input type="text" placeholder="Last Name" name="lName">
                    <input type="text" placeholder="City" name="city">
                    <input type="text" placeholder="Country" name="country">
                    <input type="text" placeholder="Email" name="email">
                    <input type="text" placeholder="Password" name="password">
                    <input type="text" placeholder="Confirm Password" name="confirm">
                    <button id="signUp" type="submit">Sign Up</button>
                </form>

            </div>

        </div>
    </main>

</body>
<script src="js/template.js"></script>
</html>