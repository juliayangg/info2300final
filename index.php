<?php
if(!isset($_SESSION)) {
    session_start(); 
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>Home | Cornell Media and Entertainment</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
        <?php 
            require_once "includes/functions.php";
            add_versioned_file( 'scripts/jquery-1.11.3.min.js', 'JavaScript' );
            add_versioned_file( 'scripts/jssor.slider-23.1.6.mini.js', 'JavaScript' );
            add_versioned_file( 'scripts/slide.js', 'JavaScript' );
            add_versioned_file( 'css/slide.css', 'Style' );
            add_versioned_file( 'css/styles.css', 'Style' );
        ?>
    </head>
    <body>
    <?php include 'includes/nav.php';?>
        <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:1300px;height:500px;overflow:hidden;visibility:hidden;">
            <!-- Loading Screen -->
            <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:rgba(0,0,0,0.7);">
                <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                <div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
            </div>
            <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1300px;height:500px;overflow:hidden;">
                <div>
                    <img data-u="image" src="img/banner1.jpg" alt="banner"/>
                    <div style="position:absolute;top:30px;left:30px;width:480px;height:120px;z-index:0;font-size:50px;color:#ffffff;line-height:60px;font-family: 'Raleway', sans-serif;">Cornell Media &amp; Entertainment</div>
                    <div style="position:absolute;top:300px;left:30px;width:720px;height:120px;z-index:0;font-size:30px;color:#ffffff;line-height:38px;font-family: 'Montserrat', sans-serif;">CME is the first student-led multi-purpose organization on campus. Come and join us for the most fun at Cornell! </div>
                </div>
                <div>
                    <img data-u="image" src="img/banner2.jpg" alt="banner"/>
                </div>
                <div>
                    <img data-u="image" src="img/banner3.jpg" alt="banner"/>
                </div>
            </div>
            <!-- Bullet Navigator -->
            <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
                <!-- bullet navigator item prototype -->
                <div data-u="prototype" style="width:16px;height:16px;"></div>
            </div>
            <!-- Arrow Navigator -->
            <span data-u="arrowleft" class="jssora22l" style="top:0px;left:8px;width:40px;height:58px;" data-autocenter="2"></span>
            <span data-u="arrowright" class="jssora22r" style="top:0px;right:8px;width:40px;height:58px;" data-autocenter="2"></span>
        </div>
        <!-- #endregion Jssor Slider End -->
        
        <div class="text">
            <h2>Important Notes:</h2>
            <p>Hello INFO2300 graders! Welcome to this page. </p>
            <p>Please note that, in reality login function can only be accessed by manually change the URL to ".../login.php" as requested by the client. For your grading purpose, we also provide a link here: <a href=login.php style="text-decoration:underline;">Login here</a>.</p>
            <h2>About Us</h2>
            <img src="img/all.jpg" alt="CME Picture">
            <p style="text-align:left;">Cornell Media &amp; Entertainment is the first student-led multi-purpose organization on campus. It currently has around 20 officers, and are welcoming more new members to join!</p>
            <p style="text-align:left;">The club aims to both support hands-on experience and exposure to Media and Entertainment Industry. We provide opportunities for event-planning and student-organized entertainment activities on campus. We also facilitate student interest in the Entertainment industry through career assistance, networking,and extensive support.</p>
            <p style="text-align:left;">It was first founded in 2014 by several sophomores who were seeking for entertainment industry opportunities on campus. As all members of the team are Asians, they decided to found a club to promote Asian culture through running entertainment TV shows and micro films.</p>
        </div>
        
        <div class="welcome">
            <h2>Welcome to Cornell Media &amp; Entertainment! </h2>
            <h2>We appreciate your interests and look forward to seeing you at our events!</h2>
        </div>
    </body>
</html>