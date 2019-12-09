<?php 
session_start(); 
//if user is already logged in then redirect them
if (isset($_SESSION['email'])) {
    header("location: index-loggedin.php");
}

if (isset($_GET["email"])){
    echo $_GET["email"];
    echo "<br> hello";
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
            
            <div id="register">
                <h2>Create an Account</h2>
                <form id="registerForm" action="addSignup.php" method="post">
                    <input type="text" placeholder="First Name" name="fName" required value=<?= 'ralph'?>> 
                    <input type="text" placeholder="Last Name" name="lName" required value=<?= 'acusar'?>>
                    <input type="text" placeholder="Country" name="country" required value=<?= 'canada'?>>
                    <input type="text" placeholder="City" name="city" required value=<?= 'calgary'?>>
                    <input type="email" placeholder="Email" name="email" required value=<?= 'racus946@mtroyal.ca'?>>
                    <input type="password" placeholder="Password" name="password" required value=<?= 'mypassword'?>>
                    <input type="password" placeholder="Confirm Password" name="confirm" required value=<?= 'mypassword'?>>
                    <button id="signUp" type="submit" name='submit'>Sign Up</button>
                </form>
            </div>
            <!-- Enter error message when registration goes wrong -->
            <?php 
            
            if (isset($_SESSION["invalid"])){
                $errorMsg = $_SESSION["invalid"];
                echo $errorMsg;
                unset($_SESSION["invalid"]);
            }    
        
            ?>

        </div>
    </main>

</body>
<script src="js/template.js"></script>

</html>