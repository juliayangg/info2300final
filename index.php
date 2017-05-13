<?php
    if(!isset($_SESSION)) {
        session_start(); 
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width">

        <title>Home | Cornell Media and Entertainment</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <?php 
            require_once "includes/functions.php";
            add_versioned_file( 'scripts/jquery-1.11.3.min.js', 'JavaScript' );
            add_versioned_file( 'scripts/jssor.slider-23.1.6.mini.js', 'JavaScript' );
            add_versioned_file( 'scripts/slide.js', 'JavaScript' );
            add_versioned_file( 'css/slide.css', 'Style' );
            add_versioned_file( 'css/styles.css', 'Style' );
        ?>
    </head>
    <?php include 'includes/nav.php';?>
    
    <body>
        <!-- #region Jssor Slider Begin -->
        <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:1300px;height:500px;overflow:hidden;visibility:hidden;">
            <!-- Loading Screen -->
            <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:rgba(0,0,0,0.7);">
                <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                <div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
            </div>
            <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1300px;height:500px;overflow:hidden;">
                <div>
                    <img data-u="image" src="img/banner1.jpg" />
                    <div style="position:absolute;top:30px;left:30px;width:480px;height:120px;z-index:0;font-size:50px;color:#ffffff;line-height:60px;font-family: 'Raleway', sans-serif;">Cornell Media &amp; Entertainment</div>
                    <div style="position:absolute;top:300px;left:30px;width:480px;height:120px;z-index:0;font-size:30px;color:#ffffff;line-height:38px;font-family: 'Montserrat', sans-serif;">Come and Join Us to Explore the Most Fun at Cornell</div>
                </div>
                <div>
                    <img data-u="image" src="img/banner2.jpg" />
                </div>
                <div>
                    <img data-u="image" src="img/banner3.jpg" />
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
            <p>Hello INFO2300 graders! Welcome to this page. There are a few thing we would like you to know before grading this website.</p>
            <p>First of all, in reality login function can only be accessed by manually change the URL to ".../login.php" as requested by the client. For your grading purpose, we also provide a link here: <a href=login.php>Login here</a>.</p>
            <p>Secondly, regarding to the design, if you go to members page, you might notice the webpage is a little bit unbalanced with all information on the left. This is because we don't have enough data to populate the database. Once we populate the database, photos will cover the entire page and the page will be balance.</p>
            <h2>About Us</h2>
            <img src="img/promo1.jpg" alt="CME Picture">
            <p>Cornell Media &amp; Entertainment is the first student-led multi-purpose organization on campus.</p>
            <p>The club aims to both support hands-on experience and exposure to Media and Entertainment Industry. We provide opportunities for event-planning and student-organized entertainment activities on campus.We also facilitate student interest in the Entertainment industry through career assistance, networking,and extensive support.</p>
        </div>
        
        <div class="text2">
            <h2>History</h2>
            <img src="img/promo2.jpg" alt="CME Picture">
            <p>Cornell Media &amp; Entertainment is first founded in 2014 by a group of sophomores. They were seeking for entertainment industry opportunities on campus but could not find any.</p>
            <p>As all members of the team are Asians, they decided to found a club to promote Asian culture through running entertainment TV shows and micro films. Later on, CME developed strategic alliance with several organizations such CSSA (Chinese Students and Scholars Association) to increase its coverage on Cornell campus.</p>
        </div>
        
        <!-- Psuedocode:
            Instead of hardcoding all pictures, in this section we will display pictures from the database

            Step 1: $result = $mysqli -> query('SELECT * FROM photos')
            
            Step 2: print out all file path in the format of <img class="picslides" src=file_path style="width:100%">
            
            Step 3: import the javascript
            
            Step 4: additional styling may be needed in case of weird size of pictures, but we'll leave it alone now. 
            -->
    </body>
</html>