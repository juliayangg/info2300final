<html>
    <head>
        <?php
            $style_path = 'css/styles.css';
            $version = filemtime($style_path);
            echo "<link rel='stylesheet' href='$style_path?ver=$version'>";
            
            include "nav.html";
        ?>
        
        <link rel="stylesheet" type="text/css" href="css/styles.css"/>
	<link href="https://fonts.googleapis.com/css?family=Raleway:200,400,500" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700" rel="stylesheet">
    </head>
    <body>
        <div class="sidebar">
            <ul>
<!--
                <li class="selected"><a href="eboard.php?type=presvp">President/Vice-Presidents</a></li>
                <li><a href="eboard.php?type=multimedia">Multimedia</a></li>
                <li><a href="eboard.php?type=operations">Operations</a></li>
                <li><a href="eboard.php?type=finance">Finance</a></li>
                <li><a href="eboard.php?type=alumni">Alumni</a></li>
-->
<!--
            </ul>
        </div>
-->
        
        <?php
            $type = $_GET['type'];
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
                echo '<li><a href="eboard.php?type=presvp">President/Vice-Presidents</a></li>';
                    echo '<li><a href="eboard.php?type=multimedia">Multimedia</a></li>';
                    echo '<li><a href="eboard.php?type=operations">Operations</a></li>';
                    echo '<li><a href="eboard.php?type=finance">Finance</a></li>';
                    echo '<li><a href="eboard.php?type=alumni">Alumni</a></li>';
                    echo '</ul>';
                    echo '</div>';
            }
                
            function presVPsideMenu() {
                echo '<li class="selected"><a href="eboard.php?type=presvp">President/Vice-Presidents</a></li>';
                    echo '<li><a href="eboard.php?type=multimedia">Multimedia</a></li>';
                    echo '<li><a href="eboard.php?type=operations">Operations</a></li>';
                    echo '<li><a href="eboard.php?type=finance">Finance</a></li>';
                    echo '<li><a href="eboard.php?type=alumni">Alumni</a></li>';
                    echo '</ul>';
                    echo '</div>';
            }
            
            function multimediaSideMenu() {
                echo '<li><a href="eboard.php?type=presvp">President/Vice-Presidents</a></li>';
                    echo '<li class="selected"><a href="eboard.php?type=multimedia">Multimedia</a></li>';
                    echo '<li><a href="eboard.php?type=operations">Operations</a></li>';
                    echo '<li><a href="eboard.php?type=finance">Finance</a></li>';
                    echo '<li><a href="eboard.php?type=alumni">Alumni</a></li>';
                    echo '</ul>';
                    echo '</div>';
            }
            
            function operationsSideMenu() {
                echo '<li><a href="eboard.php?type=presvp">President/Vice-Presidents</a></li>';
                echo '<li><a href="eboard.php?type=multimedia">Multimedia</a></li>';
                echo '<li class="selected"><a href="eboard.php?type=operations">Operations</a></li>';
                echo '<li><a href="eboard.php?type=finance">Finance</a></li>';
                echo '<li><a href="eboard.php?type=alumni">Alumni</a></li>';
                echo '</ul>';
                echo '</div>';
            }
                
            function financeSideMenu() {
                echo '<li><a href="eboard.php?type=presvp">President/Vice-Presidents</a></li>';
                    echo '<li><a href="eboard.php?type=multimedia">Multimedia</a></li>';
                    echo '<li><a href="eboard.php?type=operations">Operations</a></li>';
                    echo '<li class="selected"><a href="eboard.php?type=finance">Finance</a></li>';
                    echo '<li><a href="eboard.php?type=alumni">Alumni</a></li>';
                    echo '</ul>';
                    echo '</div>';
            }
                
            function alumniSideMenu() {
                echo '<li><a href="eboard.php?type=presvp">President/Vice-Presidents</a></li>';
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
                            echo '<img src="img/eboard/pres.jpeg">';
                            echo '<span class="deets"><span>Joe Smoth</span></span>';
                        echo '</div>';
                        echo '<div class="picture">';
                            echo '<img src="img/eboard/vp.jpg">';
                            echo '<span class="deets"><span>Nancy Fan</span></span>';
                        echo '</div>';
                    echo '</div>';
            }
                
            function multimediaGallery() {
                echo '<h2>MULTIMEDIA</h2>';
                    echo '<div id="gallery">';
                        echo '<div class="picture">';
                            echo '<img src="img/eboard/multimedia.jpeg">';
                            echo '<span class="deets"><span>Old MacDonald</span></span>';
                        echo '</div>';
                    echo '</div>';
            }
            
            function operationsGallery() {
                echo '<h2>OPERATIONS</h2>';
                    echo '<div id="gallery">';
                        echo '<div class="picture">';
                            echo '<img src="img/eboard/operations.jpg">';
                            echo '<span class="deets"><span>Slick Dickson</span></span>';
                        echo '</div>';
                    echo '</div>';
            }
                
            function financeGallery() {
                echo '<h2>FINANCE</h2>';
                    echo '<div id="gallery">';
                        echo '<div class="picture">';
                            echo '<img src="img/eboard/finance.jpg">';
                            echo '<span class="deets"><span>Dino Saur</span></span>';
                        echo '</div>';
                    echo '</div>';
            }
                
            function alumniGallery() {
                 echo '<h2>ALUMNI</h2>';
                    echo '<div id="gallery">';
                        echo '<div class="picture">';
                            echo '<img src="img/eboard/operations.jpg">';
                            echo '<span class="deets"><span>Rich Dad</span></span>';
                        echo '</div>';
                    echo '</div>';
            }
        ?>
        
<!--        <h1>PRESIDENT/VICE-PRESIDENT</h1>-->
<!--
        <div id="gallery">
            <div class="picture">
                <img src="img/eboard/pres.jpeg">
                <span class="deets"><span>Joe Smoth</span></span>
            </div>
            <div class="picture">
                <img src="img/eboard/vp.jpg">
                <span class="deets"><span>Nancy Fan</span></span>
            </div>
        </div>
-->
    </body>
</html>