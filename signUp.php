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
    <?php include "includes/navigation.php" ; ?>

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