<?php
/***
 * File for the sign up page
 */
session_start();
//if user is already logged in then redirect them
if (isset($_SESSION['email'])) {
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
            <div id="register">
                <h2>Create an Account</h2>
                <form id="registerForm" action="addSignUp.php" method="post">
                    <!-- display error message when registration errors occur -->
                    <?php
                    if (isset($_SESSION["invalid"])) {
                        $errorMsg = $_SESSION["invalid"];
                        echo "<p class='error'>" .  $errorMsg .  " </p>";
                        unset($_SESSION["invalid"]);
                    }
                    ?>
                    <!-- save form data when registration errors occur -->
                    <input type="text" placeholder="First Name" name="fName" required value=<?php if (isset($_SESSION["firstName"])) {
                                                                                                echo $_SESSION["firstName"];
                                                                                                unset($_SESSION["firstName"]);
                                                                                            } ?>>
                    <input type="text" placeholder="Last Name" name="lName" required value=<?php if (isset($_SESSION["lastName"])) {
                                                                                                echo $_SESSION["lastName"];
                                                                                                unset($_SESSION["lastName"]);
                                                                                            } ?>>
                    <input type="text" placeholder="Country" name="country" required value=<?php if (isset($_SESSION["country"])) {
                                                                                                echo $_SESSION["country"];
                                                                                                unset($_SESSION["country"]);
                                                                                            } ?>>
                    <input type="text" placeholder="City" name="city" required value=<?php if (isset($_SESSION["city"])) {
                                                                                            echo $_SESSION["city"];
                                                                                            unset($_SESSION["city"]);
                                                                                        } ?>>
                    <!-- dont save email and password when registration failure occurs-->
                    <input type="email" placeholder="Email" name="email" required value=<?= '' ?>>
                    <input type="password" placeholder="Password" name="password" required value=<?= '' ?>>
                    <input type="password" placeholder="Confirm Password" name="confirm" required value=<?= '' ?>>
                    <button id="signUp" type="submit" name='submit'>Sign Up</button>
                </form>
            </div>
        </div>
    </main>
</body>
<script src="js/template.js"></script>

</html>