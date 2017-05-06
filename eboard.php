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

        <title>Members | Cornell Media and Entertainment</title>
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
        <div class="sidebar">        
        <?php
            $type = $_GET['type'];
            /* Psuedocode:
            The code below is only for display purpose. The final product of this page will contain a PHP that connects to SQL and display relavant member information with SQL command. 
            
            We can't implement this now because we are still waiting for clients to provide more information of the club. 
            
            Step 0: print out the sidebars. (For how to print out the sidebar, it should work similarly to the one in the events page). 
            
            Step 1: get the type.
            
            Step 2: deal with the special case when type = alumni.
                In this case, $query = 'SELECT * FROM members WHERE active = FALSE'
            
            Step 3: when type = default, change it into "%"
            
            Step 4: when type = presvp, change it into "president"
            
            Step 5: $query = "SELECT * FROM member WHERE position LIKE '%".$type."%'
            
            Step 6: $result = mysqli -> query($query)
            
            Step 7: print out a header of "All current members" or "President / VP" or "Alumni" etc according to type, and display all pictures as the $result returns. When hovering, other relevant information will all display. 
            */
            
            switch ($type) {
                case "presvp":
                    presVPsideMenu();
                    echo "<div class='content'>";
                    presVPgallery();
                    echo "</div>";
                    break;
                    
                case "multimedia":
                    multimediaSideMenu();
                    echo "<div class='content'>";
                    multimediaGallery();
                    echo "</div>";
                    break;
                    
                 case "operations":
                    operationsSideMenu();
                    echo "<div class='content'>";
                    operationsGallery();
                    echo "</div>";
                    break;
                    
                case "finance":
                    financeSideMenu();
                    echo "<div class='content'>";
                    financeGallery();
                    echo "</div>";
                    break;
                    
                case "alumni":
                    alumniSideMenu();
                    echo "<div class='content'>";
                    alumniGallery();
                    echo "</div>";
                    break;
                
                default: 
                    sideMenu();
                    echo "<div class='content'>";
                    presVPgallery();
                    multimediaGallery();
                    operationsGallery();
                    financeGallery();
                    alumniGallery();
                    echo "</div>";
                    break;
            }
            
            function sideMenu() {
                echo '<ul>';
                echo '<li class="selected"><a href="eboard.php?type=default">All</a></li>';
                echo '<li><a href="eboard.php?type=presvp">President/VP</a></li>';
                echo '<li><a href="eboard.php?type=multimedia">Multimedia</a></li>';
                echo '<li><a href="eboard.php?type=operations">Operations</a></li>';
                echo '<li><a href="eboard.php?type=finance">Finance</a></li>';
                echo '<li><a href="eboard.php?type=alumni">Alumni</a></li>';
                echo '</ul>';
                echo '</div>';
            }
                
            function presVPsideMenu() {
                echo '<ul>';
                echo '<li><a href="eboard.php?type=default">All</a></li>';
                echo '<li class="selected"><a href="eboard.php?type=presvp">President/VP</a></li>';
                echo '<li><a href="eboard.php?type=multimedia">Multimedia</a></li>';
                echo '<li><a href="eboard.php?type=operations">Operations</a></li>';
                echo '<li><a href="eboard.php?type=finance">Finance</a></li>';
                echo '<li><a href="eboard.php?type=alumni">Alumni</a></li>';
                echo '</ul>';
                echo '</div>';
            }
            
            function multimediaSideMenu() {
                echo '<ul>';
                echo '<li><a href="eboard.php?type=default">All</a></li>';
                echo '<li><a href="eboard.php?type=presvp">President/VP</a></li>';
                echo '<li class="selected"><a href="eboard.php?type=multimedia">Multimedia</a></li>';
                echo '<li><a href="eboard.php?type=operations">Operations</a></li>';
                echo '<li><a href="eboard.php?type=finance">Finance</a></li>';
                echo '<li><a href="eboard.php?type=alumni">Alumni</a></li>';
                echo '</ul>';
                echo '</div>';
            }
            
            function operationsSideMenu() {
                echo '<ul>';
                echo '<li><a href="eboard.php?type=default">All</a></li>';
                echo '<li><a href="eboard.php?type=presvp">President/VP</a></li>';
                echo '<li><a href="eboard.php?type=multimedia">Multimedia</a></li>';
                echo '<li class="selected"><a href="eboard.php?type=operations">Operations</a></li>';
                echo '<li><a href="eboard.php?type=finance">Finance</a></li>';
                echo '<li><a href="eboard.php?type=alumni">Alumni</a></li>';
                echo '</ul>';
                echo '</div>';
            }
                
            function financeSideMenu() {
                echo '<ul>';
                echo '<li><a href="eboard.php?type=default">All</a></li>';
                echo '<li><a href="eboard.php?type=presvp">President/VP</a></li>';
                echo '<li><a href="eboard.php?type=multimedia">Multimedia</a></li>';
                echo '<li><a href="eboard.php?type=operations">Operations</a></li>';
                echo '<li class="selected"><a href="eboard.php?type=finance">Finance</a></li>';
                echo '<li><a href="eboard.php?type=alumni">Alumni</a></li>';
                echo '</ul>';
                echo '</div>';
            }
                
            function alumniSideMenu() {
                echo '<ul>';                
                echo '<li><a href="eboard.php?type=default">All</a></li>';
                echo '<li><a href="eboard.php?type=presvp">President/VP</a></li>';
                echo '<li><a href="eboard.php?type=multimedia">Multimedia</a></li>';
                echo '<li><a href="eboard.php?type=operations">Operations</a></li>';
                echo '<li><a href="eboard.php?type=finance">Finance</a></li>';
                echo '<li class="selected"><a href="eboard.php?type=alumni">Alumni</a></li>';
                echo '</ul>';
                echo '</div>';
            }

            function presVPgallery() {
                echo '<h2>PRESIDENT/VICE-PRESIDENTS</h2>';
                    echo '<div id="gallery">';
                        echo '<div class="picture">';
                            echo '<img src="img/pres.jpeg">';
                            echo "<span class='deets'><span>Joe Smoth<br> AEM'19 <br> President</span></span>";
                        echo '</div>';
                        echo '<div class="picture">';
                            echo '<img src="img/vp.jpg">';
                            echo "<span class='deets'><span>Nancy Fan<br> Econ'18 <br> Vice President</span></span>";
                        echo '</div>';
                    echo '</div>';
            }
                
            function multimediaGallery() {
                echo '<h2>MULTIMEDIA</h2>';
                    echo '<div id="gallery">';
                        echo '<div class="picture">';
                            echo '<img src="img/multimedia.jpeg">';
                            echo '<span class="deets"><span>Old MacDonald</span></span>';
                        echo '</div>';
                    echo '</div>';
            }
            
            function operationsGallery() {
                echo '<h2>OPERATIONS</h2>';
                    echo '<div id="gallery">';
                        echo '<div class="picture">';
                            echo '<img src="img/operations.jpg">';
                            echo '<span class="deets"><span>Slick Dickson</span></span>';
                        echo '</div>';
                    echo '</div>';
            }
                
            function financeGallery() {
                echo '<h2>FINANCE</h2>';
                    echo '<div id="gallery">';
                        echo '<div class="picture">';
                            echo '<img src="img/finance.jpg">';
                            echo '<span class="deets"><span>Dino Saur</span></span>';
                        echo '</div>';
                    echo '</div>';
            }
                
            function alumniGallery() {
                 echo '<h2>ALUMNI</h2>';
                    echo '<div id="gallery">';
                        echo '<div class="picture">';
                            echo '<img src="img/operations.jpg">';
                            echo '<span class="deets"><span>Rich Dad</span></span>';
                        echo '</div>';
                    echo '</div>';
            }
        ?>
        </div>
    </body>
</html>