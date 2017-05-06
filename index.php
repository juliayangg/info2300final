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
        //add_versioned_file( 'js/scripts.js', 'JavaScript' );
        add_versioned_file( 'css/styles.css', 'Style' );
        ?>
    </head>
    <?php include 'includes/nav.php';?>
    
    <body>
        <div class="text">
            <h2>Important Notes:</h2>
            <p>Hello INFO2300 graders! Welcome to this page. There are a few thing we would like you to know before grading this website.</p>
            <p>First of all, in reality login function can only be accessed by manually change the URL to ".../login.php" as requested by the client. For your grading purpose, we also provide a link here: <a href=login.php>Login here</a>.</p>
            <p>Secondly, regarding to the design, if you go to members page, you might notice the webpage is a little bit unbalanced with all information on the left. This is because we don't have enough data to populate the database. Once we populate the database, photos will cover the entire page and the page will be balance.</p>
            <h2>About Us</h2>
            <img src="img/promo1.jpg" alt="CME Picture">
            <p>Cornell Media & Entertainment is the first student-led multi-purpose organization on campus.</p>
            <p>The club aims to both support hands-on experience and exposure to Media and Entertainment Industry. We provide opportunities for event-planning and student-organized entertainment activities on campus.We also facilitate student interest in the Entertainment industry through career assistance, networking,and extensive support.</p>
        </div>
        
        <div class="text2">
            <h2>History</h2>
            <img src="img/promo2.jpg" alt="CME Picture">
            <p>Cornell Media & Entertainment is first founded in 2014 by a group of sophomores. They were seeking for entertainment industry opportunities on campus but could not find any.</p>
            <p>As all members of the team are Asians, they decided to found a club to promote Asian culture through running entertainment TV shows and micro films. Later on, CME developed strategic alliance with several organizations such CSSA (Chinese Students and Scholars Association) to increase its coverage on Cornell campus.</p>
        </div>
        <div style="max-width:70%; margin:auto; padding-bottom:50px;">
            <img class="picslides" src="img/rm.jpg" style="width:100%">
            <img class="picslides" src="img/rm2.jpg" style="width:100%">
            <img class="picslides" src="img/rm3.jpg" style="width:100%">
        </div>
        <script type="text/javascript" src="scripts/imageslide.js"></script>
        <!-- Psuedocode:
            Instead of hardcoding all pictures, in this section we will display pictures from the database

            Step 1: $result = $mysqli -> query('SELECT * FROM photos')
            
            Step 2: print out all file path in the format of <img class="picslides" src=file_path style="width:100%">
            
            Step 3: import the javascript
            
            Step 4: additional styling may be needed in case of weird size of pictures, but we'll leave it alone now. 
            -->
    </body>
</html>