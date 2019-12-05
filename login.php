<!DOCTYPE html>
<html>
<head>
    <?php 
        $title = "Login";
        include "includes/head.php";
    ?>
    <link rel="stylesheet" href="css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
</head>

<body>
    <main class="container">
    <?php include "includes/navigation.php" ; ?>
        <div class="main">
            <div id="content">
                <h2>LOGIN</h2>
                <form id='loginForm' action='../includes/session.php' method='post'>
                    <input type="text" id="email" placeholder="Email" name="email" required>
                    <input type="password" id="password" placeholder="Password" name="password" required>
                    <button type=button id="cancel">CANCEL</button>
                    <button type=submit id="login">LOGIN</button>
                </form>
            </div>
        </div>
    </main>
<script src="js/template.js"></script>
</html>