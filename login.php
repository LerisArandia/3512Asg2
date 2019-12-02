<!DOCTYPE html>
<html>
<head>
    <?php 
        $title = "Login";
        include "includes/head.php";
    ?>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <main class="container">
    <?php include "includes/navigation.php" ; ?>
        <div class="main">
            <input type="text" id="email" placeholder="Enter Email" name="email" required>
            <input type="text" id="password" placeholder="Enter Password" name="password" required>
            <button type=button id="login">LOGIN</button>
            <button type=button id="signup">SIGN UP</button>
        </div>
    </main>
<script src="js/template.js"></script>
</html>