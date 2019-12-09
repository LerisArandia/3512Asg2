<?php
    require_once('database/config.inc.php');
    require_once('includes/session-functions.php');

    if(isset($_SESSION['email'])){
        header("location: index-loggedin.php");
    }

    // unset($_SESSION['email']);

?>
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
        <?php include "includes/navigation.php"; ?>
        <div class="main">
            <div id="content">
                <?php
                    if(isset($_SESSION["registerGood"])){
                        $msg = $_SESSION["registerGood"];
                        echo $msg;
                        unset($_SESSION["registerGood"]);
                    }
                ?>
                <h2>LOGIN</h2>
                <form id='loginForm' action='load.php' method='post'>

                <?php
                    if(isset($login_status) && false == $login_status) : ?>
                    <div class="error">
                        <p>Your username and/or password are incorrect. Please try again!</p>
                    </div>
                <?php endif; ?>

                    <input type="text" id="email" placeholder="Email" name="email" required>
                    <input type="password" id="password" placeholder="Password" name="password" required>

                    <!-- <button type=button action=""id="cancel">CANCEL</button> -->
                    <a id="cancel" href="index.php">CANCEL</a>
                    <button type=submit id="login">LOGIN</button>
                </form>
            </div>
        </div>
    </main>
    <script src="js/template.js"></script>
    <!-- <script src="js/login.js"></script> -->

</html>