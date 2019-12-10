<?php session_start(); ?>
<!--------------------- ABOUT PAGE  --------------------->

<!DOCTYPE html>
<html>
<head>
    <?php 
        $title = "About";
        include "includes/head.php";
    ?>
    <link rel="stylesheet" href="css/about.css">
</head>

<body>
    <main class="container">
    <?php include "includes/navigation.php" ; ?>
        <div class="main">

            <!-- Group Picture -->
            <div id='bannerImage'>
                <img id='groupPic' src="images/group.jpg">
            </div>

            <!-- Contains class, uni, professor, sem/year, tech used, and website description -->
            <div id="details">
                    <p id='class'>COMP 3512: Web Development II</p> 
                    <p id='university'>Mount Royal University</p> 
                    <p id='prof'>Randy Connolly</p> 
                    <p id='semYear'>Fall 2019</p>
                    <p id='tech'>
                        Tech Used
                        <ul>
                            <li>Google Cloud Platform</li>
                            <li>XAMPP</li>
                            <li>Visual Studio Code</li>
                        </ul>
                    </p>    
                    <p id="description">
                        <p>
                            LJR is a travel photo website where you can browse photos from across the globe and save the ones that awaken the traveller in you! Share your experiences with the community through a personal photo page and show off your own photos as well. 
                        </p>
                    </p>
            </div>

            <!-- Contains group members, github information, and referenced external links -->
            <div id="group">
                <div>
                    <p class='personName'>Main Github Page</p>
                    <a href="https://github.com/racus946/3512Asg2">https://github.com/racus946/3512Asg2</a>
                </div>
                <div>
                    <img class='personIcon' src='images/ralph.jpg'>
                    <p class='personName'>Ralph Acusar</p> 
                    <a href="https://github.com/racus946">https://github.com/racus946</a>
                </div>
                <div>
                    <img class='personIcon' src='images/leris.jpg'> 
                    <p class='personName'>Leris Arandia</p>
                    <a href="https://github.com/LerisArandia">https://github.com/LerisArandia</a>
                </div>
                <div>
                    <img class='personIcon' src='images/jamie.jpg'> 
                    <p class='personName'>Jamie Wong</p> 
                    <a href="https://github.com/jaeemoo">https://github.com/jaeemoo</a>
                </div>
                <div id='references'>
                    External Resources:
                    <ul>
                        <li>
                                AJAX
                            <ul>
                                <li>https://github.com/dcode-youtube/js-ajax-form-submission</li>
                                <li>https://youtu.be/zvt8ff3d63Q</li>
                            </ul>
                        </li>
                        <li>
                            Sidebar Navigation: https://www.w3schools.com/howto/howto_js_sidenav.asp
                        </li>
                        <li>
                            Interactive Google Map: Referenced code from Chapter 10 Lab (Javascript 3: APIs): Exercise 7 
                        </li>
                        <li>
                        Referenced individual Assignment 1
                        </li>
                        <li>
                            Burger Menu: https://www.w3schools.com/howto/howto_js_mobile_navbar.asp
                        </li>
                        <li>
                            Substring function: https://tecadmin.net/check-string-contains-substring-in-php
                        </li>
                    </ul>
                
                </div> <!-- End of References -->
            
            </div> <!-- End of Group Info -->
        
        </div> <!-- End of Main-->
    </main>
    <script src="js/template.js"></script>
</html>