<?php 
session_start(); 
if (isset($_SESSION['id'])) {
    header("location: index-loggedin.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php
    $title = "Sign Up";
    include "includes/head.php";
    ?>
    <link rel="stylesheet" href="css/signUp.css">
</head>

<body>
    <main class="container">
        <?php include "includes/navigation.php"; ?>

        <div class="main">
            <h2>Create an Account</h2>
            <div id="register">
                <form id="registerForm" action="addSignup.php" method="post">
                    <input type="text" placeholder="First Name" name="fName" required>
                    <input type="text" placeholder="Last Name" name="lName" required>
                    <input type="text" placeholder="City" name="city" required>
                    <input type="text" placeholder="Country" name="country" required>
                    <input type="email" placeholder="Email" name="email" required>
                    <input type="password" placeholder="Password" name="password" required>
                    <input type="password" placeholder="Confirm Password" name="confirm" required>
                    <button id="signUp" type="submit" name='submit'>Sign Up</button>
                </form>

            </div>

        </div>
    </main>

</body>
<script src="js/template.js"></script>

</html>